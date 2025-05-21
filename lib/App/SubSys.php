<?php namespace App;

class SubSys extends \PreFab {
    const MODE_404 = 404;
    const MODE_403 = 403;
    protected $subsys_id=null;
    protected $subsys_name=null;
    protected $subsys_mode=self::MODE_404;
    protected $subsys_session=true;
    protected $subsys_login=false;

    public function beforeroute() {
        $f3=\Base::instance();
        $db=$f3->get('DB');
        $session_table=my_name."_sessions";
        if ($this->subsys_session) {
            session_name(my_name);
            new \DB\SQL\Session(
                                $f3->get("DB"),
                                $session_table,
                                TRUE,
                                function($session) {
                                    $f3=\Base::instance();
                                    $sIPc = $f3->get('IP');
                                    $sIPs = $session->ip();
                                    $sAgentc = $f3->get('AGENT');
                                    $sAgents = $session->agent();
                                    say('onsuspect triggered:');
                                    say('... old: %s',$sIPs);
                                    say('... new: %s',$sIPc);
                                    say('... old: %s',$sAgents);
                                    say('... new: %s',$sAgentc);
                                    // The default behaviour destroys the suspicious session.
                                    return true;
                                },
                                'CSRF');
            session_start();
            $rows = $db->exec("select * from cstools_kv where k in ('centraldb_ts','blox_linked')");
            foreach($rows as $row) {
                switch($row['k']) {
                 case 'centraldb_ts':
                    $ts = \DateTime::createFromFormat('YmdHis',$row['v']);
                    if ($ts) {
                        $cts = $ts->format("m/d/Y h:i:s a");
                    }
                    else {
                        $cts = $row['v'];
                    }
                    $f3->set('FEED_CENTRALDB',$cts);
                    break;
                 case 'blox_linked':
                    $ts = \DateTime::createFromFormat('YmdHis',$row['v']);
                    if ($ts) {
                        $cts = $ts->format("m/d/Y h:i:s a");
                    }
                    else {
                        $cts = $row['v'];
                    }
                    $f3->set('FEED_LINKEDACCT',$cts);
                    break;
                }
            }
        }
        
        if ($this->subsys_login) {
            
        }
    }    
}
    
