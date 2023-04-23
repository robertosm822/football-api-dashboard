<?php

namespace Soccer\Api\Controller;

class ErrorHandler
{
    //CSS constantes :: Mensagens de Erro
    public function __construct(
        public readonly string $accept,
        public readonly string $infor,
        public readonly string $alert,
        public readonly string $error,
    ) {
        self::$accept = 'accept';
        self::$infor = 'infor';
        self::$alert = 'alert';
        self::$error = 'error';
    }

    //WSErro :: Exibe erros lançados :: Front
    public static function WSErro($ErrMsg, $ErrNo, $ErrDie = null)
    {
        $CssClass = ($ErrNo == E_USER_NOTICE ? self::$infor : ($ErrNo == E_USER_WARNING ? self::$alert : ($ErrNo == E_USER_ERROR ? self::$error : $ErrNo)));
        echo json_encode("<p class=\"trigger {$CssClass}\">{$ErrMsg}<span class=\"ajax_close\"></span></p>");
        http_response_code(422);
        if ($ErrDie) :
            die;
        endif;
    }

    //PHPErro :: personaliza o gatilho do PHP
    public static function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine)
    {
        $CssClass = ($ErrNo == E_USER_NOTICE ? self::$infor : ($ErrNo == E_USER_WARNING ? self::$alert : ($ErrNo == E_USER_ERROR ? self::$error : $ErrNo)));
        echo "<p class=\"trigger {$CssClass}\">";
        echo "<b>Erro na Linha: #{$ErrLine} ::</b> {$ErrMsg}<br>";
        echo "<small>{$ErrFile}</small>";
        echo "<span class=\"ajax_close\"></span></p>";
        http_response_code(500);
        if ($ErrNo == E_USER_ERROR) :
            die;
        endif;
    }
}
