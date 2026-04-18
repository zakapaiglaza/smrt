<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Зворотній зв'язок</title>
    <link rel="stylesheet" href="/css/widget.css">
</head>
<body>
    <div class="widget">
        <h2>Зв'яжіться з нами</h2>

        <form id="ticketForm">
            <div class="form-group">
                <label>Ім'я</label>
                <input type="text" name="name" placeholder="Ваше ім'я">
                <div class="field-error" id="error-name"></div>
            </div>
            <div class="form-group">
                <label>Телефон</label>
                <input type="text" name="phone" placeholder="+380991234567">
                <div class="field-error" id="error-phone"></div>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="email@example.com">
                <div class="field-error" id="error-email"></div>
            </div>
            <div class="form-group">
                <label>Тема</label>
                <input type="text" name="subject" placeholder="Тема звернення">
                <div class="field-error" id="error-subject"></div>
            </div>
            <div class="form-group">
                <label>Повідомлення</label>
                <textarea name="body" placeholder="Ваше повідомлення"></textarea>
                <div class="field-error" id="error-body"></div>
            </div>

            <div class="form-group">
                <label>Файли (необов'язково)</label>
                <input type="file" name="files[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.txt">
                <div class="field-error" id="error-files"></div>
            </div>

            <button type="submit" id="submitBtn">Надіслати</button>
        </form>

        <div class="message success" id="successMsg">Дякуємо! Ваша заявка прийнята.</div>
        <div class="message error" id="errorMsg"></div>
    </div>

    <script src="/js/widget.js"></script>
</body>
</html>