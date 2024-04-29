<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録情報の確認</title>
</head>
<body>
    <h1>保険情報のご確認</h1>
    <p>以下の通り、あなたの保険情報が登録されています。</p>
    <table>
        <tr>
            <th>氏名</th>
            <td>{{ $insured->name }}</td>
        </tr>
        <tr>
            <th>カナ（姓）</th>
            <td>{{ $insured->last_name_kana }}</td>
        </tr>
        <tr>
            <th>カナ（名）</th>
            <td>{{ $insured->first_name_kana }}</td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>{{ $insured->email }}</td>
        </tr>
        <tr>
            <th>保険証番号</th>
            <td>{{ $insured->insurance_card_number }}</td>
        </tr>
        <tr>
            <th>保険証記号</th>
            <td>{{ $insured->insurance_card_symbol }}</td>
        </tr>
    </table>
    <p>情報に誤りがないことをご確認ください。</p>
</body>
</html>
