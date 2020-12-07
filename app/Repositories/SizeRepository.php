<?php

namespace Repositories;

use Repositories\Support\AbstractRepository;
use App\Notifications\Notificate;
use Pusher\Pusher;

class SizeRepository extends AbstractRepository {

    public function __construct(\Illuminate\Container\Container $app) {
        parent::__construct($app);
    }

    public function model() {
        return 'App\Size';
    }



}
