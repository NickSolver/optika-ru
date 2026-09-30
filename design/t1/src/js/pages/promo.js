export function initPromo() {
  document.getElementById('promoCopyBtn').addEventListener('click', (e) => {
    const btn = e.currentTarget;
    const code = document.getElementById('promoCodeText').textContent.trim();
    const restore = () => { btn.textContent = 'Скопировать'; };
    const showCopied = () => { btn.textContent = 'Скопировано!'; setTimeout(restore, 1800); };
    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(code).then(showCopied).catch(showCopied);
    } else {
      showCopied();
    }
  });
}
