<?php

namespace app\models;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

use Yii;
// use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use app\models\Order;

class SocketServer
    implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }
   
    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }
 
    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true);
        if (is_null($data))
        {
            echo "invalid data\n";
            return $from->close();
        }

        switch ($data['action']) {
            case 'kitchen':
                $dataProvider = new ActiveDataProvider([
                    'query' => Order::find()->joinWith('owner')
                        ->where(['!=', 'condition', 'ready'])
                        ->orderBy('id DESC'),
                ]);
                $dataProvider->setPagination(false);
                $json = array();
                foreach ($dataProvider->getModels() as $record) {
                    $json['data'][] = array(
                        $record->id,
                        $record->table_number,
                        $record->title,
                        $record->estimated_time,
                        $record->owner->fullName,
                        // Url::to(['order/update']),
                        '/index.php?r=order/edit-order&id='.$record->id,
                    );
                }
                break;

            case 'saloon':
                $dataProvider = new ActiveDataProvider([
                    'query' => Order::find()->joinWith('owner')
                        ->where(['owner_id' => $data['user_id']])
                        ->orderBy('id DESC'),
                ]);
                $dataProvider->setPagination(false);
                $json = array();
                foreach ($dataProvider->getModels() as $record) {
                    $json['data'][] = array(
                        $record->id,
                        $record->title,
                        $record->condition,
                        $record->estimated_time,
                    );
                }
                break;

            case 'edit-order':
                $model = Order::findOne($data['data']['order_id']);
                $model->estimated_time = date("Y-m-d H:i", strtotime($data['data']['estimated_time'] ?: 'now'));
                $model->condition = $data['data']['condition'] ?: 'new';

                if ($model->estimated_time && $model->condition != 'ready')
                    $model->condition = 'pending';
                $model->save();

                $json['task'] = 'reload';
                foreach ($this->clients as $conn)
                    $conn->send(json_encode($json));
                return;

            case 'make-order':
                $model = new Order();
                $model->owner_id = $data['user_id'];
                $model->condition = 'new';
                $model->title = $data['data']['title'];
                $model->table_number = $data['data']['table_number'];
                $model->save();

                $json['task'] = 'reload';
                foreach ($this->clients as $conn)
                    $conn->send(json_encode($json));
                return;

            default:
                $json['task'] = 'reload';
                foreach ($this->clients as $conn)
                    $conn->send(json_encode($json));
                return;
        }

        if(!empty($json))
            $from->send(json_encode($json));
        echo $from->resourceId."\n";
    }
 
    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }
 
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}
