<?php

namespace app\controllers;

use app\models\Author;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SubscriptionForm;
use app\models\Book;
use app\models\Subscription;
use yii\web\BadRequestHttpException;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Author();
        return $this->render(
            'index',
            [
                'top' => [
                    2010 => $model->getTopAuthors(2010),
                    2020 => $model->getTopAuthors(2020),
                ]
            ]
        );
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Subscription action.
     *
     * @return Response|string
     */
    public function actionSubscription(int $bookId)
    {
        $book = Book::findOne((int) $bookId);
        if (is_null($book)) {
            throw new BadRequestHttpException('Книги не существует!');
        }

        $model = new SubscriptionForm();
        if ($model->load(Yii::$app->request->post())) {
            if (!$model->validate()) {
                throw new BadRequestHttpException('Номер телефона не коректен!');
            }
            $subscription = new Subscription();
            $old = $subscription->findOne([
                'book_id' => $book->id,
                'phone' => $model->telNumber,
                'is_send' => 0
            ]);
            if (!is_null($old)) {
                throw new BadRequestHttpException('Подписка уже оформлена!');
            }
            $subscription->phone = $model->telNumber;
            $subscription->book_id = $book->id;
            if (!$subscription->save()) {
                throw new BadRequestHttpException('Произошла ошибка, попробуйте позже!');
            }

            return $this->render('success');
        }

        return $this->render('subscription', [
            'model' => $model,
            'bookId' => $book->id,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
