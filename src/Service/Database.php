<?php
/**
 * Scarawler Database Service
 *
 * @package: Scrawler
 * @author: Pranjal Pandey
 */

namespace Scrawler\Service;

use Scrawler\Scrawler;
use\Scrawler\Arca\Database as Arca;
use\Scrawler\Arca\Model;

class Database extends Arca
{
    public __construct()
    {
        $config = Scrawler::engine()->config()->all();
        $connectionParams = array(
            'dbname' => $config['database']['database'],
            'user' => $config['database']['username'],
            'password' =>  $config['database']['password'],
            'host' => $config['database']['host'],
            'driver' => 'pdo_mysql', //You can use other supported driver this is the most basic mysql driver
        );
        parent::__construct($connectionParams);
    }
  
    /**
     * Bind all value from incoming request to model 
     * and saves it.
     *
     * @param Model|String $model
     * @return int|string $id
     */
    public function saveRequest($model)
    {
        if (!($model instanceof Model)) {
            $model = $this->create($model);
        }

        foreach (Scrawler::engine()->request()->all() as $key => $value) {
            if ($key != 'csrf') {
                $model->$key = $value;
            }
        }
        return $this->save($model);
    }

    /**
     * Bind all value from incoming request to model 
     *
     * @param Model|String $model
     * @return Model
     */
    public function bindRequest($model)
    {
        if (!($model instanceof Model)) {
            $model = $this->create($model);
        }

        foreach (Scrawler::engine()->request()->all() as $key => $value) {
            if ($key != 'csrf') {
                $model->$key = $value;
            }
        }

        return $model;
    }
}
