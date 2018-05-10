<?php
/**
 * Created by Aktaa.
 * User: Mohammad Aktaa
 * Date: 5/8/2018
 * Time: 7:26 PM
 */

namespace Aktaa\translatable\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Translate;
use \Illuminate\Http\Request;
use Translatable;
class TranslateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $translates=Translate::all();
        return view('translates.index',compact('translates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model=getTranslateModel();
        $translate=$model::find($id)->getAllAttributes();
        return $translate;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
//        dd($request->input());
        $model=getTranslateModel();
        $model::create($request->input());
        return['success'=>true,'msg'=>translate('save_success',Translatable::getCurrentLocale(),'Save Successfully')];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return array
     */
    public function update(Request $request, $id)
    {
        $model=getTranslateModel();
        $trans=$model::find($id);
        $trans->update($request->input());
        return ['msg' => translate('save_success',Translatable::getCurrentLocale(),'Save Successfully')];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id)
    {
        $model=getTranslateModel();
        $model::delete($id);
        return ['msg' => translate('save_success',Translatable::getCurrentLocale(),'Save Successfully')];
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function deleteWord($id)
    {
        $model=getTranslateModel();
        $model::destroy($id);
        return ['msg' => translate('save_success',Translatable::getCurrentLocale(),'Save Successfully')];
    }

    public function viewAddWord()
    {
        return view('translates.translate');
    }

    public function getTable()
    {
        $translates=Translate::all();
        return view('translates.table',compact('translates'));
    }
}