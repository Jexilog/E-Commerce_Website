<!-- filepath: c:\xampp\htdocs\AudioHub\src\components\product-page\review-section.php -->
<?php
$reviews = [
    [
        'user' => 'Alice',
        'rating' => 5,
        'comment' => 'Great audio quality and fast delivery!',
        'date' => '2025-06-10'
    ],
    [
        'user' => 'Bob',
        'rating' => 4,
        'comment' => 'Good selection of materials.',
        'date' => '2025-06-12'
    ],
    [
        'user' => 'Charlie',
        'rating' => 3,
        'comment' => 'Average experience, but support was helpful.',
        'date' => '2025-06-14'
    ],
    [
        'user' => 'Kat',
        'rating' => 2,
        'comment' => 'Below average experience, support was not helpful.',
        'date' => '2025-06-14'
    ],
    [
        'user' => 'Zynnah',
        'rating' => 1,
        'comment' => 'Terrible service, will not buy again.',
        'date' => '2025-06-15'
    ],
    [
        'user' => 'Aliyah',
        'rating' => 4,
        'comment' => 'Decent quality, but could use more variety especially and the use Keven image',
        'date' => '2025-06-16'
    ],
    [
        'user' => 'John',
        'rating' => 5,
        'comment' => 'Absolutely love the new tracks! Great service.',
        'date' => '2025-06-17'
    ],
    [
        'user' => 'Cielo',
        'rating' => 4,
        'comment' => 'Very satisfied with my purchase, will recommend to friends.',
        'date' => '2025-06-18'
    ],
    [
        'user' => 'Mike',
        'rating' => 3,
        'comment' => 'Decent quality, but delivery was slow.',
        'date' => '2025-06-19'
    ],
    [
        'user' => 'Sara',
        'rating' => 5,
        'comment' => 'Fantastic experience, will definitely buy again!',
        'date' => '2025-06-20'
    ],
    [
        'user' => 'Liam',
        'rating' => 4,
        'comment' => 'Good quality, but the website could be more user-friendly.',
        'date' => '2025-06-21'
    ],
    [
        'user' => 'Ben',
        'rating' => 5,
        'comment' => 'Excellent service and high-quality products, very happy with my purchase!',
        'date' => '2025-06-22'
    ],
];
?>

<style>
.review-section {
    max-width: 900px;
    margin: 40px auto;
    padding: 0 16px;
}
.review-section h2 {
    text-align: left;
    margin-bottom: 32px;
    color: #003366;
    font-size: 2em;
    letter-spacing: 1px;
}
.review-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 24px;
}
.review-card {
    background: #fafbfc;
    border-radius: 14px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.07);
    padding: 24px 20px 18px 20px;
    display: flex;
    flex-direction: column;
    min-height: 210px;
    transition: box-shadow 0.2s;
}
.review-card:hover {
    box-shadow: 0 6px 24px rgba(0,0,0,0.13);
}
.review-card .review-header {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}
.review-card .user-avatar {
    width: 38px;
    height: 38px;
    background: #e0e7ff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: #3b3b3b;
    margin-right: 12px;
    font-size: 1.1em;
    box-shadow: 0 1px 4px rgba(0,0,0,0.04);
}
.review-card .user-details {
    display: flex;
    flex-direction: column;
}
.review-card .user-name {
    font-weight: 600;
    color: #222;
    font-size: 1.07em;
}
.review-card .review-date {
    color: #8a8a8a;
    font-size: 0.93em;
}
.review-card .review-rating {
    margin-left: auto;
    color: #f7b731;
    font-size: 1.1em;
}
.review-card .review-comment {
    margin-top: 14px;
    color: #444;
    font-size: 1.08em;
    flex: 1;
}
</style>

<div class="review-section">
    <h2><i class="bi bi-chat-dots" style="margin-right: 10px;"></i>Customer Reviews</h2>
    <div class="review-grid">
        <?php foreach ($reviews as $review): ?>
            <div class="review-card">
                <div class="review-header">
                    <div class="user-avatar">
                        <?php echo strtoupper($review['user'][0]); ?>
                    </div>
                    <div class="user-details">
                        <span class="user-name"><?php echo htmlspecialchars($review['user']); ?></span>
                        <span class="review-date"><?php echo htmlspecialchars($review['date']); ?></span>
                    </div>
                    <span class="review-rating">
                        <?php for ($i = 0; $i < $review['rating']; $i++) echo '★'; ?>
                        <?php for ($i = $review['rating']; $i < 5; $i++) echo '☆'; ?>
                    </span>
                </div>
                <div class="review-comment">
                    <?php echo htmlspecialchars($review['comment']); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>