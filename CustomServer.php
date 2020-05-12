<?php

/**
 * Custom Gearman Server
 * 
 * basic testing and configuration
 * with gearman 1.1.18+ds
 * 
 * GEARMAN ver. 1.1.18+ds
 * PHP Ver. 5.6
 * 
 * @author Rafay Hingoro
 */
class CustomServer {

    // gearman worker
    protected $worker = null;

    // no work
    protected $executable = false;
    
    /**
     * Initializing some basic things init
     * 
     * @param array|string
     * 
     * @return void
     */
    public function __construct( $servers = 'localhost' )
    {
        $this->worker = new GearmanWorker();

        $this->addServer( $servers );
    }

    /**
     * Add Servers
     * 
     * @param array|string
     * 
     * @return $this|mixed
     */
    public function addServer($server = 'localhost')
    {
        // validating on multiple servers passed 
        if( is_array( $server ) && !empty( $server ) ) {
            foreach( $server as $s ) {
                $this->worker->addServer( $s );
            }
        // basic validation if no value passed
        } else if ( empty( trim($server) ) || is_null( $server ) ) {
            throw new \Exception( 'server details missing' );
        } else {
            $this->worker->addServer( $server );
        }

        return $this;
    }

    /**
     * Add Work
     * 
     * @param string
     * @param callback
     * 
     * @return mixed
     */
    public function addWork( $work, $fn = null )
    {
        if ( is_null($fn) ) { $this->executable = false; }
        $this->executable = true;
        $this->worker->addFunction( $work, $fn );
    }

    /**
     * Exceute Works
     * 
     * @return void
     */
    public function run()
    {
        if( $this->executable ) {
            while( $this->worker->work() );
        }
    }

}