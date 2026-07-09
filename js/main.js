document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.getElementById('menuToggle');
    const mainNav = document.getElementById('mainNav');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function () {
            mainNav.classList.toggle('open');
        });
    }

    const qtyInput = document.getElementById('qtyInput');
    const qtyMinus = document.getElementById('qtyMinus');
    const qtyPlus = document.getElementById('qtyPlus');

    if (qtyInput && qtyMinus && qtyPlus) {
        qtyMinus.addEventListener('click', function () {
            let value = parseInt(qtyInput.value, 10) || 1;
            if (value > 1) {
                qtyInput.value = value - 1;
            }
        });

        qtyPlus.addEventListener('click', function () {
            let value = parseInt(qtyInput.value, 10) || 1;
            if (value < 20) {
                qtyInput.value = value + 1;
            }
        });
    }
});
