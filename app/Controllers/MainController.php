<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MainModelPM;

class MainController extends BaseController
{
    private $playlists;
    private $music;
    


    public function __construct()
    {
        $this->playlists = new \App\Models\MainModel1();
        $this->music = new \App\Models\MainModel();
    }
    public function index()
    {
        //
    }
    public function view()
    {
        $data = [
            'playlists' => $this->playlists->findAll(),
            'song' => $this->music->findAll(),

        ];
        return view ('view', $data);
    }

    public function createPlaylist()
    {
        $data = [
            'name' => $this->request->getVar('pname'),
        ];

        $this->playlists->save($data);
        return redirect()->to('/view');
    }

    public function addmusic()
    {

        $validationRules = [
            'music' => 'uploaded[music]|max_size[music,10240]|mime_in[music,audio/mpeg,audio/wav]',
        ];
        if ($this->validate($validationRules)) {


            $music = $this->request->getFile('music');
            $musicname = $music->getName();
            $newName = $music->getRandomName();
            $music->move(ROOTPATH . 'uploads', $newName);
            $data = [
                'title' => $musicname,
                'file_path' => $newName,
                //make sure tama names ng collumns
            ];
            $this->music->insert($data);
            return redirect()->to('/view');
        } else {
            $data['validation'] = $this->validator;
            echo "error";
        }
    }
}
