// Main JS for Landing Page
document.addEventListener('DOMContentLoaded', function () {
    // --- FAQ Accordion Logic ---
    const faqs = document.querySelectorAll('.faq-question');

    // Safety check: Chỉ chạy JS nếu khối FAQ thực sự tồn tại trên trang
    if (faqs.length > 0) {
        faqs.forEach(faq => {
            faq.addEventListener('click', function () {
                const item = this.parentElement;
                if (!item) return; // Đảm bảo thẻ cha tồn tại

                const isOpen = item.classList.contains('active');
                const answer = item.querySelector('.faq-answer');

                if (isOpen) {
                    item.classList.remove('active');
                    if (answer) answer.style.maxHeight = null; // Kiểm tra thẻ con trước khi gán CSS
                } else {
                    item.classList.add('active');
                    if (answer) answer.style.maxHeight = answer.scrollHeight + "px";
                }
            });
        });

        // Mở sẵn câu hỏi đầu tiên lúc mới load trang
        faqs[0].click();

        // Recalculate height on window resize or full load to prevent text cut-off
        window.addEventListener('resize', function () {
            document.querySelectorAll('.faq-item.active .faq-answer').forEach(answer => {
                answer.style.maxHeight = 'none'; // Reset to auto calculate
                answer.style.maxHeight = answer.scrollHeight + 'px'; // Set new height
            });
        });
        
        window.addEventListener('load', function () {
            window.dispatchEvent(new Event('resize'));
        });
    }
});
