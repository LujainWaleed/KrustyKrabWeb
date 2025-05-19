fetch('../api/feedback.php') // Change 'your-project-name' to your actual project folder name
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById('feedback-container');
        if (data.success && data.data.length > 0) {
            data.data.forEach(feedback => {
                const card = document.createElement('div');

                card.innerHTML = `
                    <strong>${feedback.full_name}</strong><br>
                    <small>${new Date(feedback.submission_date).toLocaleString()}</small><br><br>
                    <strong>Experience:</strong> ${feedback.experience_rating}/5<br>
                    <strong>Food:</strong> ${feedback.food_rating}/5<br>
                    <em>"${feedback.comments}"</em>
                `;
                container.appendChild(card);
            });
        } else {
            const noFeedback = document.createElement('p');
            noFeedback.textContent = 'No feedback has been submitted yet.';
            container.appendChild(noFeedback);
        }
    })
    .catch(error => {
        console.error('Error fetching feedback:', error);
        const errorMsg = document.createElement('p');
        errorMsg.textContent = 'Failed to load recent feedback.';
        errorMsg.style.color = 'red';
        document.getElementById('feedback-container').appendChild(errorMsg);
    });