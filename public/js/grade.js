function setGrade() {
    let selects = document.querySelectorAll('.grade-select');

    selects.forEach(select => {
        select.addEventListener('change', function () {
            const selectedGrade = this.value;
            const userId = this.dataset.userId;
            const assignmentId = this.dataset.assignmentId;

            const formData = new FormData();
            formData.append('user_id', userId);
            formData.append('assignment_id', assignmentId);
            formData.append('grade', selectedGrade);

            ajaxRequest('/api/grade/update', 'POST', formData, function (error, data) {
                if (error) {
                    console.error('Update failed', error);
                    alert('Update failed');
                    return;
                }

                if (data.success) {
                    console.log('Updated');
                } else {
                    alert('Update failed');
                }

            });
        });
    });
}

setGrade();
