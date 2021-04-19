<?php

//UpadateAdminIdeaThemeResult
//IdeaThemeへのアタッチ

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\IdeaThemeResult;
use App\IdeaTheme;
use App\Http\Requests\AdminIdeaThemeResult;
use App\Http\Requests\UpdateAdminIdeaTheme;
use Illuminate\Support\Facades\Storage;

class IdeaThemeResultController extends Controller
{
    /**
    * テーマ企画インスタンス
    */
    protected $idea_theme;
    protected $idea_theme_result;

    /**
    * 新しいコントローラインスタンスの生成
    *
    * @param  UserRepository  $users
    * @return void
    */
    public function __construct(IdeaTheme $idea_theme)
    {
        $this->idea_theme = IdeaTheme::withoutGlobalScope('public')->get();
        $this->idea_theme_result = IdeaThemeResult::withoutGlobalScope('public')->get();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        //indexは使わない(IdeaThemeでresultも表示)
/*    public function index()
    {
        $idea_theme = IdeaTheme::with('result')
        ->orderBy('created_at', 'desc')
        ->get();

        $param = [
            'idea_theme' => $idea_theme,
        ];
        return view('admin.idea_theme.result.index', $param);
    }
*/
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(empty($request->idea_theme_id)){
            return redirect()->route('admin.idea_theme_result.index');
        }
        $param = [
            'idea_theme_id' => $request->idea_theme_id,
        ];
        return view('admin.idea_theme_result.create', $param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminIdeaThemeResult $request)
    {
        $idea_theme = $this->idea_theme->find($request->idea_theme_id);

        $path = Storage::disk('public')->putfile('idea_theme', $request->file('banner'));
        $path = str_replace('idea_theme/', '', $path);

        $idea_theme_result = new IdeaThemeResult([
            'banner' => $path,
            'body' => $request->input('body'),
        ]);
        $idea_theme->result()->save($idea_theme_result);
        return redirect()->route('admin.idea_theme.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(IdeaThemeResult $idea_theme_result)
    {
        $idea_theme = $idea_theme_result->idea_theme;
        $param = [
            'idea_theme' => $idea_theme,
            'idea_theme_result' => $idea_theme_result,
        ];
        return view('admin.idea_theme_result.show', $param);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idea_theme_result)
    {
        $idea_theme_result = $this->idea_theme_result->find($idea_theme_result);
        $param = [
            'idea_theme_result' => $idea_theme_result,
        ];
        return view('admin.idea_theme_result.edit', $param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idea_theme_result)
    {
        $idea_theme_result = $this->idea_theme_result->find($idea_theme_result);

        if($request->hasFile('banner')){
            $path = Storage::disk('public')->putfile('idea_theme', $request->file('banner'));
            $path = str_replace('idea_theme/', '', $path);
            $idea_theme_result->banner = $path;
        }
        $idea_theme_result->body = $request->body;
        if($request->published_at == 'public'){
            $idea_theme_result->published_at = now();
        }elseif($request->published_at == 'hidden'){
            $idea_theme_result->published_at = NULL;
        }

        $idea_theme_result->save();
        return redirect()->route('admin.idea_theme.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idea_theme_result)
    {
        $idea_theme_result = $this->idea_theme_result->find($idea_theme_result);
        $idea_theme_result->delete();
        return redirect()->route('admin.idea_theme.index');
   }
}
