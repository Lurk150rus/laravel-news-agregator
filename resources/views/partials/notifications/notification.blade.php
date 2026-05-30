<div id="toast-container" style="
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 10px;
"></div>


<script>
    function showToast(message, type = 'info') {
        const container = document.getElementById('toast-container');

        const el = document.createElement('div');

        el.innerText = message;

        el.style.padding = '10px 14px';
        el.style.borderRadius = '6px';
        el.style.color = '#fff';
        el.style.fontSize = '14px';
        el.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
        el.style.cursor = 'pointer';
        el.style.transition = 'all 0.3s ease';
        el.style.opacity = '1';

        // цвета по типу
        if (type === 'success') el.style.background = '#16a34a';
        else if (type === 'error') el.style.background = '#dc2626';
        else el.style.background = '#2563eb';

        container.appendChild(el);

        // автоскрытие
        setTimeout(() => {
            el.style.opacity = '0';
            el.style.transform = 'translateX(20px)';
            setTimeout(() => el.remove(), 300);
        }, 3000);

        // клик чтобы закрыть
        el.onclick = () => el.remove();
    }

</script>

<script>
    const es = new EventSource('/stream/notifications');
    const shown = new Set();

    es.onmessage = function(event) {

        const data = JSON.parse(event.data);

        const key = `${data.id}`;

        if (shown.has(key)) {
            return;
        }

        shown.add(key);

        showToast(data.message);
    };

</script>
