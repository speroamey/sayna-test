<?php
    // File: app/Traits/SingletonTrait.php

    namespace App\Traits;
    trait SingletonTrait
    {
        protected static $instance;

        public static function getInstance()
        {
            if (!isset(static::$instance)) {
                static::$instance = new static();
            }

            return static::$instance;
        }
    }
