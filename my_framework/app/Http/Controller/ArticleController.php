<?php

namespace App\Http\Controller;

use Asus\Core\Controller;
use Asus\Core\Request;
use Rakit\Validation\Validator;
 use App\Models\Article;

class ArticleController extends Controller
{

    public function index($articleId, $articleSlug)
    {
        
        echo "$articleId<br>$articleSlug<br>article $articleId page";
        
    }
    public function createArticle(){
        $article = new Article();
        $article->create(['title'=>'article 4','body'=>'this is article 4']);
        $article->create(['title'=>'article 5','body'=>'this is article 5']);
        $article->create(['title'=>'article 6','body'=>'this is article 6']);
        $article->create(['title'=>'article 7','body'=>'this is article 7']);
        $article->create(['title'=>'article 8','body'=>'this is article 8']);
        return 'article created';
    }
    
    public function editArticle(){
        $article = new Article();
        $article->edit(['title'=>'article three','body'=>'this is article three'],3);
        return 'article edited';
    }

    public function deleteArticle(){
        $article = new Article();
        $article->delete(3);
        return 'article deleted';
    }
    public function getArticles()
    {
        $article = new Article();
        // $articles=$article->get();
        //$articles=$article->getFirst();
        // $articles=$article->getFieldsForSelect()->get();
        //$articles=$article->getFieldsForSelect('id','title')->limit(5)->get();
        //$articles=$article->where('id',1)->where('title','article one')->getFirst();
        $articles=$article->find(7);
        var_dump($articles);
    }
    public function create(Request $request)
    {

        // $request=new Request();
        var_dump($request->all());
        //var_dump($request->query('name'));
        //return $request->input('name');
        return $this->render('articles.create',[
            'title'=>'titleeeeee',
            'title2'=>'titleeee2',
            'auth'=>false
        ]);
    }
    public function store(Request $request, Validator $validator)
    {

        $validation= $this->validate($request->all(), [
            'title'   => 'required|min:5'
        ]);


        if ($validation->fails()) {
            // handling errors
            $errors = $validation->errors();
            echo "<pre>";
            print_r($errors->firstOfAll());
            echo "</pre>";
            exit;
        } else {
            // validation passes
            echo "Success!<br><br>";
        }


        // $request=new Request();
        var_dump($request->all());
        echo "<br>article title: " . $_POST['title'] . "<br>";
        return $request->input('title');
    }
}
