<!DOCTYPE html>
<html>
<head>
    <base href="/">
    <meta charset="UTF-8" />
    <title>Siple Web-Socket Client</title>
</head>
<body>
<br /><br />

<script src="assets\custom\js\socket.js" type="text/javascript"></script>


Server address:
<!--
    ws://echo.websocket.org
    ws://127.0.0.1:889
    ws://gridyardci/:889
     ws://gridyardci:8889
-->
<input id="sock-addr" type="text" value=" ws://gridyardci:8889"><br />
Message:
<input id="sock-msg" type="text">

<input id="sock-send-butt" type="button" value="send">
<br />
<br />
<input id="sock-recon-butt" type="button" value="reconnect"><input id="sock-disc-butt" type="button" value="disconnect">
<br />
<br />

Полученные сообщения от веб-сокета: 
<div id="sock-info" style="border: 1px solid"> </div>

</body>
</html>