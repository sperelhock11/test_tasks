<?php

namespace app\commands;

use yii\console\Controller;
use yii\db\Query;
use Yii;

class SuperController extends Controller
{
    public function actionInitRBAC(): void
    {
        $auth = Yii::$app->authManager;

        $allInclusive = $auth->createPermission('allInclusive');
        $allInclusive->description = 'All inclusive mode';
        $auth->add($allInclusive);

        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $allInclusive);

        $auth->assign($user, 100);
        $auth->assign($user, 101);
    }

    public function actionSendMsg(): void
    {
        $db = new Query();
        $data = $db->select('subscription.id, subscription.phone, book.name')
            ->from('subscription')
            ->leftJoin('storage', 'storage.book_id = subscription.book_id')
            ->leftJoin('book', 'storage.book_id = book.id')
            ->where('subscription.is_send = 0 AND storage.quantity > 0')
            ->limit(100)
            ->all();
        
        if (count($data) === 0) {
            return;
        }

        $ids = [];
        foreach ($data as $el) {
            $ids[] = (int) $el['id'];
            echo 'Уведомление на номер: ' . $el['phone'] . ' книга ' . $el['name'] . ' появилась в наличии.' . PHP_EOL;
        }

        $ids = implode(',', $ids);
        Yii::$app->db->createCommand('UPDATE subscription SET is_send=1 WHERE FIND_IN_SET(id, :ids)')
            ->bindParam(':ids', $ids)
            ->execute();
    }
}
