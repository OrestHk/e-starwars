<?php

  include('Config.php');

  /**
   * Set server project server configuration
   * @param {string} host in which you want to create the database
   * @param {string} host login
   * @param {string} host password
   * @param {string} database name
   */
  new Config('localhost', 'root', '', 'starwars');
