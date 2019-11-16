<?php

namespace App\Http\Controllers;

use App\Website;
use App\WebsiteBuilderUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Util\Json;
use App\ApiAdapter;
use Session;

class WebsiteController extends Controller
{
    public $adapter;
    public $website;

    public function __construct()
    {
        $this->adapter = new ApiAdapter;
        $domain_id = str_replace(':8012', '', $_SERVER['HTTP_HOST']);
        $website_row = json_decode($this->adapter->getWebsitesByDomainId($domain_id));
        if(!array_key_exists('id', $website_row)){
            die('Website with domain_id "'.$domain_id.'" not found!');
        }
        $this->website = new Website;
        $this->website->loadWebsite($website_row);
    }

    public function login(){
        return view('website.login');
    }

    public function postlogin(Request $request){
        {
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:50|',
                'password' => 'required|string|min:6|'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data = $request->only('username', 'password');
            $row = json_decode($this->adapter->getWebsiteBuilderUserByUsernameAndPassword($data));
            if(!empty($row->errors)){ //no response from API
                $error = new \Illuminate\Support\MessageBag(['credentials' => 'Incorrect username or password']);
                return redirect()->back()->withErrors($validator)->withErrors($error)->withInput();
            }
            $website_builder_user = new WebsiteBuilderUser;
            $website_builder_user->loadFromRow($row);
            Session::put('user_id', $website_builder_user->id);
            echo 'You are logged in';
            return redirect('/dashboard');
            //do something when logged in
        }
    }

    public function dashboard(){
        if(Session::get('user_id')){
            return view('website.dashboard');
        } else {
            return view('website.login');
        }
    }
    public function logout() {
        Session::flush();
        return back();
    }

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function show(Website $website)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function edit(Website $website)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Website $website)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function destroy(Website $website)
    {
        //
    }
}
