<?php

require_once('controller/base_controller.php');
require_once('model/category.php');
require_once('model/post.php');
require_once('model/banner.php');
require_once('model/info.php');
class PagesController extends BaseController
{
  function __construct()
  {
    
  }

  public function home()
  {
    $data = array(
    'category' => Category::all(),
    'post' => post::recentPost(8),
    'banner' => Banner::all(),
    'info' => info::select()
    );
    $this->render('web/pages/home', $data);
  }
  public function blog()
  {
    if(isset($_GET['category_slug'])){
      $data = array(
        'category' => Category::all(),
        'post' => post::getPostByCategory($_GET['category_slug'])
        );
        $this->render('web/pages/blog', $data);
      
    }else{
    $data = array(
      'category' => Category::all(),
      'post' => post::panigation(16,1)['list']
      );
    }
    $this->render('web/pages/blog', $data);
  }
  public function view_post()
  {
    if(isset($_GET['id'])){
      $data = array(
        'category' => Category::all(),
        'post' => Post::find($_GET['id']),
        'last_post' => Post::recentPost(5)
            );
      return $this->render('web/pages/post' ,$data);
    }
    $this->render('web/pages/error');
  }
  public function view_banner()
  {
    if(isset($_GET['id'])){
      $data = array(
        'category' => Category::all(),
        'banner' => banner::find($_GET['id']),
        'last_post' => Post::recentPost(5)
            );
      return $this->render('web/pages/view_banner' ,$data);
    }
    $this->render('web/pages/error');
  }
  public function contact()
  {
    $data = array(
      'category' => Category::all(),
      'info' => info::select()
    );
    $this->render('web/pages/contact', $data);
  }
  public function about()
  {
    $data = array(
      'category' => Category::all()
    );
    $this->render('web/pages/about', $data);
  }

  public function error()
  {
    $data = array(
      'category' => Category::all()
    );
    $this->render('web/pages/error', $data);
  }
}