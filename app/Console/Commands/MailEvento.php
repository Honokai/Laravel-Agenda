<?php

namespace App\Console\Commands;

use App\Eventos;
use App\Notifications\AvisoEvento;
use App\User;
use Illuminate\Console\Command;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Bus\Queueable;

class MailEvento extends Command
{
    use Queueable;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MailEvento:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command E-mail';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        $data = date('d/m/Y', strtotime(' +1 day'));
        $evento = DB::select("select `usuarios`.`nome` as `advisor`, `usuarios`.`email` as `email`, `eventos`.`nome` as `evento`, `eventos`.`data` as `data` from `eventos` inner join `usuarios` on `eventos`.`usuario_id` = `usuarios`.`id` where DATE_FORMAT(eventos.data,'%d/%m/%Y') = '$data'");

        $check = 0;
        
        foreach($evento as $item){
            
            $usuario = new User;
            $usuario->nome = $item->advisor;
            $usuario->evento = $item->evento;
            $usuario->data = $item->data;
            $usuario->email = $item->email;
            $usuario->notify(new AvisoEvento);
            $check = 1;
        }
        
        if($check == 1) {
            $this->info('MailEventos:Cron Cummand Run successfully!');
        } else {
            $this->info('MailEventos:Cron Cummand Run into an ERROR!');
        }
        
        
        
    }
}
