<?php
/**
 * Ar default public config file.
 *
 * @author ycassnr <ycassnr@gmail.com>
 */
return array(
    // 模板后缀
    'TPL_SUFFIX' => 'html',
    // 关闭 trace 显示
    'DEBUG_SHOW_TRACE' => false,

    // 组件配置开始
    'components' => array(
        // 懒惰加载
        'db' => array(
            // 懒惰加载
            'lazy' => true,
            // mysql数据库组件
            'mysql' => array(
                'config' => array(
                    // 读库
                    'read' => array(
                        // 默认读库配置
                        'default' => array(
                            'dsn' => 'mysql:host=localhost;dbname=work;port=3306',
                            'user' => 'root',
                            'pass' => 'root',
                            'prefix' => '',
                            'option' => array(
                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
                                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
                            ),
                        ),
                        // 默认读库配置
                        'test2' => array(
                            'dsn' => 'mysql:host=localhost;dbname=test2;port=3306',
                            'user' => 'root',
                            'pass' => 'qweasd',
                            'prefix' => '',
                            'option' => array(
                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
                                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    // 模块列表
    'moduleLists' => array(
        'main'
    ),
);