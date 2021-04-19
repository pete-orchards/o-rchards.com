<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\IdeaThemePost;
use App\IdeaThemeResult;
use App\IdeaTheme;
use App\Post;

class IdeaThemePostsController extends Controller
{
    /**
    * テーマ企画インスタンス
    */
    protected $idea_theme;

    /**
    * 新しいコントローラインスタンスの生成
    *
    * @param  UserRepository  $users
    * @return void
    */
    public function __construct(IdeaTheme $idea_theme)
    {
        $this->idea_theme = IdeaTheme::withoutGlobalScope('public')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idea_theme = '')
    {
        if(empty($idea_theme)){
            return redirect()->route('admin.home');
        }
        $idea_theme = $this->idea_theme
        ->find($idea_theme);


        $posts = Post::whereHas('tags', function($query) use($idea_theme){
            $query->where('name', $idea_theme->tag);
        })
        ->withCount('goods')
        ->orderBy('goods_count', 'desc')
        ->get();
        $param = [
            'idea_theme' => $idea_theme,
            'posts' => $posts,
        ];
        return view('admin.idea_theme_posts.index', $param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idea_theme)
    {
        $idea_theme = $this->idea_theme->find($idea_theme);

        $idea_theme->posts()->attach($request->post_id, ['name' => $request->name]);

        return redirect()->route('admin.idea_theme.posts.index', ['idea_theme' => $idea_theme]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idea_theme, $post)
    {
        $idea_theme = $this->idea_theme->find($idea_theme);

        if($request->published_at == 'public'){
            $idea_theme->posts()->updateExistingPivot($request->post_id, ['published_at' => now()]);
        }elseif($request->published_at == 'hidden'){
            $idea_theme->posts()->updateExistingPivot($request->post_id, ['published_at' => NULL]);
        }

        return redirect()->route('admin.idea_theme.posts.index', ['idea_theme' => $idea_theme]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $idea_theme, $post)
    {
        $idea_theme_post = IdeaThemePost::withoutGlobalScope('public')->find($post);
        $idea_theme_post->delete();
/*なぜかうまく動作しない
        $idea_theme = $this->idea_theme->find($idea_theme);
        $idea_theme->posts_all()->detach($request->post_id);
*/
        return redirect()->route('admin.idea_theme.posts.index', ['idea_theme' => $idea_theme]);
    }
}
