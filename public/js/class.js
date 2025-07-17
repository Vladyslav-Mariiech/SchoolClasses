const groupForm = document.getElementById('group-create-form');

function createGroupShow() {
    const createBtn = document.querySelector('button.group-create-btn');
    createBtn.addEventListener('click', function () {
        document.querySelector('div.form-group-create').classList.remove('hide');
    });
}

function createGroupHide() {
    const hideBtn = document.querySelector('div.form-group-create button[type="reset"]');
    hideBtn.addEventListener('click', function () {
        document.querySelector('div.form-group-create').classList.add('hide');
    });
}

function createGroup() {
    sendFormData(groupForm, '/class/add', function (error, data) {
        if (error) {
            alert(error);
        } else {
            groupForm.reset();
            document.querySelector('div.form-group-create').classList.add('hide');
            getGroups();
        }
    });

}

function getGroups() {
    ajaxRequest('/class/all', 'GET', null, function (error, data) {
        fillGroups(data);
    });
}

function fillGroups(groups) {
    if (groups) {
        const teacherGroups = document.getElementById('teacher-group');
        const studentGroups = document.getElementById('student-group');
        let teacherTable = '';
        let studentTable = '';

        for (let group of groups['owner']) {
            teacherTable += `<tr><td><a href="/class/show?id=${group['link']}">${group['name']}</a></td></tr>`;
        }

        for (let group of groups['member']) {
            studentTable += `<tr><td><a href="/class/show?id=${group['link']}">${group['name']}</a></td></tr>`;
        }

        teacherGroups.querySelector('tbody').innerHTML = teacherTable;
        studentGroups.querySelector('tbody').innerHTML = studentTable;
    }
}

createGroupShow();
createGroupHide();
createGroup();