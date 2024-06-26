<?php
/**
 * Ckeditor editor plugin.
 *
 * It transforms all the editable areas into the Ckeditor inline editor.
 *
 * @author Prakai Nadee <prakai@rmuti.acth>
 * @forked by Robert Isoski @robertisoski
 */

global $Wcms;

if (defined('VERSION')) {
    $Wcms->addListener('js', 'loadSummerNoteJSs');
    $Wcms->addListener('css', 'loadSummerNoteCSSs');
    $Wcms->addListener('editable', 'initialSummerNoteVariabless');
}

function initialSummerNoteVariabless($contents) {
    global $Wcms;
    $content = $contents[0];
    $subside = $contents[1];

    $contents_path = $Wcms->getConfig('contents_path');
    if (!$contents_path) {
        $Wcms->setConfig('contents_path', $Wcms->filesPath);
        $contents_path = $Wcms->filesPath;
    }
    $contents_path_n = trim($contents_path, "/");
    if ($contents_path != $contents_path_n) {
        $contents_path = $contents_path_n;
        $Wcms->setConfig('contents_path', $contents_path);
    }
    $_SESSION['contents_path'] = $contents_path;

    return array($content, $subside);
}

function loadSummerNoteJSs($args) {
    global $Wcms;
    if ($Wcms->loggedIn) {
        $script = <<<EOT
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha384-vk5WoKIaW/vJyUAd9n/wmopsmNhiy+L2Z+SBxGYnUkunIxVxAv/UtMOhba/xskxh" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
        <script src="https://cdn.ckeditor.com/4.19.1/standard-all/ckeditor.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/browser-image-compression@2.0.0/dist/browser-image-compression.js" integrity="sha384-R5lOA9Vhja/AeGXhZyjsK0c+bpRhE5wPdquWfVrFgnHV6PtTQWggYgeqigzcRf+6" crossorigin="anonymous"></script>
        <script src="{$Wcms->url('plugins/ckeditors/js/admin.js')}" type="text/javascript"></script>
        <script src="{$Wcms->url('plugins/ckeditors/js/files.js')}" type="text/javascript"></script>
EOT;
        $args[0] .= $script;
    }
    return $args;
}

function loadSummerNoteCSSs($args) {
    global $Wcms;
    if ($Wcms->loggedIn) {
        $script = <<<EOT
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" integrity="sha384-Vh3Vqtlg6hMZ+IvHz4CNfftJxpVDzx0goO9b4ECMD15HcLHtoCUUXYgsFrvN+fgn" crossorigin="anonymous">
        <link rel="stylesheet" href="{$Wcms->url('plugins/ckeditors/css/admin.css')}" type="text/css" media="screen">
EOT;
        $args[0] .= $script;
    }
    return $args;
}
