<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Http\Resources\Article as ArticleResource;

class ArticleController extends Controller
{

    public function index()
    {
        // Get articles
        $articles = Article::paginate(15);

        // Return collection of articles as a resource
        return ArticleResource::collection($articles);
    }


    public function store(Request $request)
    {

        $this->validate($request , ['title'=>'required','body'=>'required']);

        $article = Article::create($request->all());


        if($article->save()) {
            return new ArticleResource($article);
        }

    }

    public function update(Request $request , $id){


        $article = Article::findOrFail($id);
        $updated = $article->update($request->all());
        if($updated){
            return "it is updated";
        }

        return new ArticleResource($article);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get article
        $article = Article::findOrFail($id);

        // Return single article as a resource
        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get article
        $article = Article::findOrFail($id);

        if($article->delete()) {
            return new ArticleResource($article);
        }
    }
}