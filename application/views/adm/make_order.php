<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Make order <br>
    <form action="" method="post">
    login- <input type="text" name="login"><br>
    date - <input type="datetime-local" name="date"><br>
    <hr>
    buy price- <input type="number" step="0.01" min="0.01" name="buy_price"><br>
    summ YRD- <input type="number" step="0.01" min="0.01" name="buy_tok"><br>
    <hr>
    sell price- <input type="number" step="0.01" min="0.01" name="sell_price"><br>
    <button type="submit">Submit</button>
    </form>
    <br>

    <p><?=$message?></p>
</body>
</html>