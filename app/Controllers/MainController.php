<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MainController extends BaseController
{
    private $music;
    private $spotifyplaylist;
    private $track;
    private $db;

    public function index()
    {
        //
    }

    public function __construct()
    {
        $this->music = new \App\Models\MainModel();
        $this->spotifyplaylist = new \App\Models\MainModel1();
        $this->track = new \App\Models\MainModelPM();
        $this->db = \Config\Database::connect();
        helper('form');
    }

    public function view()
    {
        $context = 'home';
        $data = [
            'spotifyplaylist' => $this->spotifyplaylist->findAll(),
            'music' => $this->music->findAll(),
            'context' => $context,
        ];
        return view('view', $data);
    }


    public function magupload()
{
    $file = $this->request->getFile('song');
    $newFileName = $file->getRandomName();

    $data = [
        'title' => pathinfo($file->getName(), PATHINFO_FILENAME), 
        'artist' => 'Unknown', 
        'file_path' => $newFileName,
        'duration' => 0, 
        'album' => 'Unknown', 
        'genre' => 'Unknown',
    ];

    $tuntunin = [
        'song' => [
            'uploaded[song]',
            'mime_in[song,audio/mpeg]',
            'max_size[song,10240]',
            'ext_in[song,mp3]',
        ],
    ];

    if ($this->validate($tuntunin)) {
        if ($file->isValid() && !$file->hasMoved()) {
            if ($file->move(FCPATH . 'uploads\songs', $newFileName)) {
                
                $this->music->save($data);
                echo 'File uploaded successfully';
            } else {
                echo $file->getErrorString() . ' ' . $file->getError();
            }
        }
    } else {
        $data['validation'] = $this->validator;
    }

    return redirect()->to('/view');
}



    public function addToPlaylist()
    {
        $musicID = $this->request->getPost('musicID');
        $playlistID = $this->request->getPost('playlist');


        $data = [
            'playlist_id' => $playlistID,
            'music_id' => $musicID
        ];

        $this->track->insert($data);

        return redirect()->to('/view');
    }

    public function removeFromPlaylist($musicID)
    {

        $builder = $this->db->table('track');
        $builder->where('id', $musicID);
        $builder->delete();

        return redirect()->to('/view');
    }

    public function create_playlist()
    {
        $data = [
            'name' => $this->request->getVar('playlist_name'),
            'music' => $this->music->findAll(),
        ];

        $this->spotifyplaylist->insert($data);
        return redirect()->to('/view');
    }

    public function delete_playlist($playlistID)
    {
        $playlist = $this->spotifyplaylist->find($playlistID);

        if ($playlist) {

            $this->track->where('playlist_id', $playlistID)->delete();

            $this->spotifyplaylist->delete($playlistID);
        }


        return redirect()->to('/view');
    }

    public function viewPlaylist($playlistID)
    {
        $context = 'playlist';

        $builder = $this->db->table('track');

        $builder->select('track.id, music.*');

        $builder->join('music', 'music.music_id = track.music_id');

        $builder->where('track.playlist_id', $playlistID);

        $musicInPlaylist = $builder->get()->getResultArray();

        $data = [
            'music' => $musicInPlaylist,
            'playlistmusicsong' => $this->spotifyplaylist->findAll(),
            'context' => $context,
        ];

        return view('view', $data);
    }

    public function search()
    {
        $searchTerm = $this->request->getGet('search');
        $context = $this->request->getGet('context');
        $builder = $this->db->table('music');

        if ($context === 'home') {

            // Search all songs
            $builder->like('title', $searchTerm.'%');
        } elseif ($context === 'playlist') {

            // Search songs in the current playlist
            $playlistID = $this->request->getGet('playlistID');
            $builder
                ->join('track', 'track.music_id = music.music_id')
                ->where('track.playlist_id', $playlistID)
                ->like('music.title', $searchTerm.'%');
        } else {
            
        }


        $results = $builder->get()->getResultArray();

    
        $data = [
            'music' => $results,
            'spotifyplaylist' => $this->spotifyplaylist->findAll(),
            'context' => $context,
        ];

        return view('view', $data);
    }

}
