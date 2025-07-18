const groupForm = document.getElementById('group-create-form');

function createGroup() {
    sendFormData(groupForm, '/api/class/add', function (error, data) {
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
    ajaxRequest('/api/class/all', 'GET', null, function (error, data) {
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

function inviteGroup() {
    ajaxRequest('/api/class/owned', 'GET', null, function (error, data) {
        const groupsContainer = document.querySelector('.invite-section-groups');
        let html = '';
        for (let group of data) {
            html += `<div class="invite-section-groups-group"><a data-group-uid=${group['link']} href="">${group['name']}</a></div>`;
        }
        groupsContainer.innerHTML = html;
        groupsContainer.onclick = function (e) {
            if (e.target.tagName === 'A') {
                e.preventDefault();
                document.querySelector('.invite-close-btn').click();
                const link = e.target.dataset.groupUid;
                const domain = window.location.hostname;
                document.querySelector('.invite-link-popup-content').innerText = `${domain}/api/class/invite/?id=${link}`;
                const inviteLinkPopup = document.querySelector('.invite-link-popup');
                inviteLinkPopup.classList.remove('hide');
                // document.querySelector('.link-close-btn').addEventListener('click', () => {
                //     inviteLinkPopup.classList.add('hide');
                // });
                document.body.onclick = function(e){
                    console.log(e);
                    if(!inviteLinkPopup.contains(e.target) && e.target.tagName !== 'A'){
                        inviteLinkPopup.classList.add('hide');
                        document.body.onclick = undefined;
                    }
                };
            }
        };

    });

}

function init() {
    const createGroupBtn = document.querySelector('button.group-create-btn');
    const groupPopup = document.querySelector('div.form-group-create');
    const hideFormBtn = document.querySelector('div.form-group-create button[type="reset"]');
    showPopup(createGroupBtn, groupPopup);
    hidePopup(hideFormBtn, groupPopup);

    const invitePopup = document.querySelector('.group-invite-popup');
    const inviteBtn = document.querySelector('.group-invite-btn');
    const hideInviteBtn = document.querySelector('.invite-close-btn');
    showPopup(inviteBtn, invitePopup, () => {
        inviteGroup();
    });
    hidePopup(hideInviteBtn, invitePopup);
    createGroup();
}

init();