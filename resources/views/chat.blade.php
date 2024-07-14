<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatBot</title>
    <script src="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js"></script>
</head>
<body>
    <h1>Chat with our bot</h1>
    <script>
        var botmanWidget = {
            frameEndpoint: '/botman/chat',
            chatServer: '/botman',
            title: 'ChatBot',
            introMessage: 'Hi, I am a ChatGPT bot!',
            placeholderText: 'Type a message...',
        };
    </script>
</body>
</html>
