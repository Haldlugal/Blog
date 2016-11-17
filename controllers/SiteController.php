<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\Pagination;

use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Posts;
use app\models\Users;
use app\models\Comments;
use app\models\AddPostForm;
use app\models\AddCommentForm;
use app\models\AddUserForm;
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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
		if (Yii::$app->user->identity->role=='Admin'){
			 $link=Yii::$app->urlManager->createUrl(['site/userlist']);
			 $countPostsToModerate=Posts::find()->where(['moderation'=>0])->count();
			 $modlink=Yii::$app->urlManager->createUrl(['site/modlist']);
			 $useraddlink="<p><a href=".$link.">Список пользователей</a></p>"; 
			 $postmoderationlink="<p><a href=".$modlink.">Модерировать посты(".$countPostsToModerate.")</a></p>"; 
		}
		$query = Posts::find()->where(['moderation'=>1]);
		$users = Users::find()->all();
		$pagination = new Pagination([
			'defaultPageSize' => 2,
			'totalCount' => $query->count()
		]);
		$posts = $query->orderBy(['date'=>SORT_DESC])
			->offset($pagination->offset)
			->limit($pagination->limit)
			->all();
			
		return $this->render('index',[
			'posts' => $posts,
			'users' => $users,
			'active_page' => Yii::$app->request->get("page", 1),
			'count_pages' => $pagination->getPageCount(),
			'pagination' => $pagination,
			'useraddlink' =>  $useraddlink,
			'postmoderationlink' => $postmoderationlink
		]);
	}
	public function actionPost()
	{
		$post = Posts::find()->where(['id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
		if (Yii::$app->user->identity->role=='user'){
		$comments = Comments::find()->where(['moderation' => 1, 'post_id'=>$post->id])->all();
		}
		else if (Yii::$app->user->identity->role=='Admin'){
		$comments = Comments::find()->where(['post_id'=>$post->id])->all();	
		}
		$author = Users::find()->where(['id' => $post->user_id])->one();
		$users = Users::find()->all();
		$model = new AddCommentForm();
		
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
		$comment = new Comments();
		$comment->user_id = Yii::$app->user->identity->id;
		$comment->post_id = $post->id;
		$comment->text = $model->text;
		$comment->moderation = 0;
		$comment->save();
		$this->refresh();
		}
		
		return $this->render('post', [
			'post' => $post,
			'comments' => $comments,
			'comments_number' => 0,
			'author' => $author,
			'users' => $users,
			'model' => $model
		]);
	}
    /**
     * Login action.
     *
     * @return string
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
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
		$users = Users::find()->all();
        return $this->render('about',[
		'users'=>$users
		]);
    }
	
	public function actionAddpost()
	{
		$model = new AddPostForm();
		
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			
			$post = new Posts();
			
			$post->user_id=Yii::$app->user->identity->id;
			$post->title = $model->title;
			$post->description = $model->description;
			$post->text = $model->text;
			$post->moderation = 0;
			$post->save();
			$this->redirect('index.php');
			
		} else {
			if (isset($_POST["address"])) $error = true;
			else $error = false;
			return $this->render('addpost', [
				'model' => $model,
				'success' => false,
				'error' => $error
			]);
		}
	}
	
	public function actionEditpost(){
		$post = Posts::find()->where(['id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
		$model = new AddPostForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			$post->description = $model->description;
			$post->text = $model->text;
			$post->moderation = 0;
			$post->save();
					
		}
		if (Yii::$app->user->identity->role=='Admin'){
			return $this->render('moderatepost', [
			'post' => $post,
			'model' => $model
			]);
		}
		else if (Yii::$app->user->identity->role=='user')
		return $this->render('editpost', [
			'post' => $post,
			'model' => $model
		]);
	}
	
	public function actionModeratepost(){
		$post = Posts::find()->where(['id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
		$model = new AddPostForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			$post->title = $model->title;
			$post->description = $model->description;
			$post->text = $model->moderation;
		if ($model->moderation!=1){$post->moderation=0;}
		else {$post->moderation = $model->moderation;}
			$post->save();
			$this->redirect('index.php?r=site%2Fmodlist');
		}
		return $this->render('moderatepost', [
			'post' => $post,
			'model' => $model
		]);
	}
	
	public function actionDeletepost(){
		$comments = Comments::find()->where(['post_id' => Yii::$app->getRequest()->getQueryParam('id')])->all();
		$post = Posts::find()->where(['id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
		foreach($comments as $comment){
		$comment->delete();
		}
		$post->delete();
		$this->redirect('index.php?r=site%2Fmodlist');
	}
	
	public function actionUserlist(){
		if (Yii::$app->user->identity->role=='Admin'){
		$users = Users::find()->all();
		return $this->render('userlist',[
		'users' => $users
		]);
		}
		else {
			$this->redirect('index.php');
		}
	}
	
	public function actionAdduser(){
		if (Yii::$app->user->identity->role=='Admin'){
			$model = new AddUserForm();
			if ($model->load(Yii::$app->request->post()) && $model->validate()) {
				$user = new Users();
				$user->name=$model->name;
				$user->second_name=$model->second_name;
				$user->patronymic_name=$model->patronymic_name;
				$user->job_place=$model->job_place;
				$user->job_position=$model->job_position;
				$user->username=$model->username;
				$user->role=$model->role;
				$user->active=$model->activation;
				$user->password=$model->password;
				$user->save();
				$this->redirect('index.php?r=site%2Fuserlist');
				
			} else {
				if (isset($_POST["address"])) $error = true;
				else $error = false;
				return $this->render('adduser', [
					'model' => $model,
					
				]);
			}
		}
		else {
			$this->redirect('index.php');
		}
	}
	
	public function actionEdituser(){
		if (Yii::$app->user->identity->role=='Admin'){
			$user = Users::find()->where(['id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
			$model = new AddUserForm();
			if ($model->load(Yii::$app->request->post()) && $model->validate()) {
				$user->name=$model->name;
				$user->second_name=$model->second_name;
				$user->patronymic_name=$model->patronymic_name;
				$user->job_place=$model->job_place;
				$user->job_position=$model->job_position;
				$user->username=$model->username;
				$user->role=$model->role;
				$user->active=$model->activation;
				$user->password=$model->password;
				$user->save();
								
			}
			return $this->render('edituser', [
				'user' => $user,
				'model' => $model
			]);
		}
		else {
			$this->redirect('index.php');
		}
	}
	public function actionDeleteuser(){
		$comments = Comments::find()->where(['user_id' => Yii::$app->getRequest()->getQueryParam('id')])->all();
		$posts = Posts::find()->where(['user_id' => Yii::$app->getRequest()->getQueryParam('id')])->all();
		$user = Users::find()->where(['id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
		
		foreach($comments as $comment){
			$comment->user_id = 1;
			$comment->save();
		}
		foreach($posts as $post){
			$post->user_id = 1;
			$post->save();
		}
		$user->delete();
		$this->redirect('index.php?r=site%2Fuserlist');
	}
	public function actionModlist(){
		if (Yii::$app->user->identity->role=='Admin'){
		$posts=Posts::find()->where(['moderation'=>0])->all();
		return $this->render('modlist',[
			'posts' => $posts,
			'test' => $countPostsToModerate
		]);
		}
	}
	
	public function actionDeletecomment(){
		if(Yii::$app->user->identity->role=='Admin' or Yii::$app->user->id==$comment->user_id){
			$comment=Comments::find()->where(['id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
			$comment->delete();
			return $this->redirect(Yii::$app->request->referrer);
		}
	}
	
	public function actionEditcomment(){
		if(Yii::$app->user->identity->role=='Admin' or Yii::$app->user->id==$comment->user_id){
			$comment=Comments::find()->where(['id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
			$model = new AddCommentForm();
			if ($model->load(Yii::$app->request->post()) && $model->validate()) {
				$comment->text=$model->text;
				$comment->save();
				$this->redirect(Yii::$app->urlManager->createUrl(["site/post", "id" => $comment->post_id]));
				
			}
			return $this->render('editcomment',[
				'model'=>$model,
				'comment'=>$comment
			]);
		}
	}
	
	public function actionModcomment(){
		if(Yii::$app->user->identity->role=='Admin'){
			$comment=Comments::find()->where(['id' => Yii::$app->getRequest()->getQueryParam('id')])->one();
			if ($comment->moderation==0) $comment->moderation=1;
			else $comment->moderation=0;
			$comment->save();
		}
		return $this->redirect(Yii::$app->request->referrer);
	}
	
	
}
