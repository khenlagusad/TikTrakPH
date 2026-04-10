const reviewModal  = document.querySelector('#review-modal');
const closeReview  = document.querySelectorAll('#close-review');

document.querySelectorAll('.btn-review').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelector('#review-ticket').textContent      = '#' + btn.dataset.ticket;
        document.querySelector('#review-name').textContent        = btn.dataset.name;
        document.querySelector('#review-title').textContent       = btn.dataset.title;
        document.querySelector('#review-explanation').textContent = btn.dataset.explanation;
        document.querySelector('#reject-id').value                = btn.dataset.id;
        document.querySelector('#resolve-id').value               = btn.dataset.id;
        reviewModal.classList.add('active');
    });
});

closeReview.forEach(btn => btn.addEventListener('click', () => {
    reviewModal.classList.remove('active');
}));

document.querySelector('#review-notes').addEventListener('input', function() {
    document.querySelector('#reject-notes').value  = this.value;
    document.querySelector('#resolve-notes').value = this.value;
});