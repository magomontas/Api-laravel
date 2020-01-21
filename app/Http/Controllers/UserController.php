<?php

namespace App\Http\Controllers;

use App\Helpers\JwtAuth;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function register(Request $request)
    {
        //Recoger Variables por post
        $json = $request->input('json', null);
        $params = json_encode($json);

        $name = (!is_null($json) && isset($params->name)) ? $params->name : null;
        $lastname = (!is_null($json) && isset($params->lastname)) ? $params->lastname : null;
        $email = (!is_null($json) && isset($params->email)) ? $params->email : null;
        $password = (!is_null($json) && isset($params->password)) ? $params->password : null;
        $role = (!is_null($json) && isset($params->role)) ? $params->role : null;

//        if (is_null($email) && is_null($password) && is_null($name) && is_null($lastname) && is_null($role)) {
        if (!is_null($email) && !is_null($password) && !is_null($name) && !is_null($lastname) && !is_null($role)) {
            // Craer el usuario
            $user = new User();
            $user->email = $email;
            $user->name = $name;
            $user->lastname = $lastname;
            $user->role = $role;

            $pwd = hash('sha256', $password);
            $user->password = $pwd;

            //Comprobar si el usuario no existe
            $isset_user = User::where('email', '=', $email)->first();

            if (!$isset_user) {
                // Guardar el usuario
                $user->save();
                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'Usuario registrado correcctamente!'
                );
            } else {
                //No guardarlo
                $data = array(
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'No se ha podido registrar, ya existe un usuario con se Correo!'
                );
            }

        } else {
            $data = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'No se ha podido crear el usuario'
            );
        }
        return response()->json($data, 200);
    }

    public function login(Request $request)
    {
        $jwtAuth = new JwtAuth();

        // Recibir datos del post
        $json = $request->input('json', null);
        $params = json_encode($json);

        $email = (!is_null($json) && isset($params->email)) ? $params->email : null;
        $password = (!is_null($json) && isset($params->password)) ? $params->password : null;
        $getToken = (!is_null($json) && isset($params->gettoken)) ? $params->gettoken : null;

        //Cifrar la contraseña de nos llega
        $pwd = hash('sha256', $password);

        if (!is_null($email) && !is_null($password) && $getToken== null || $getToken == 'false'){
            $singup = $jwtAuth->sigup($email,$pwd);

        }elseif ($getToken !=null){
            $singup = $jwtAuth->sigup($email,$pwd,$getToken);

        }else{
            $singup = array(
                'status'=> 'error',
                'message'=>'Envia tus datos por post'
            );
        }
        return response()->json($singup,200);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "Desde el index de User Controller"; die();
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
