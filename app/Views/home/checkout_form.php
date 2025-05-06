<h2>Enter your details</h2>
<form action="/book-room" method="POST">
    <input type="hidden" name="rateKey" value="<?= esc($rateKey) ?>">
    
    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Surname:</label>
    <input type="text" name="surname" required>

    <!-- Add more fields like email, phone, etc. -->

    <button type="submit">Confirm Booking</button>
</form>
