$(function () {
    const $form = $('#student-form');
    const studentsChangedKey = 'students:changed';

    if (!$form.length) {
        return;
    }

    const csrfToken = $('input[name="_token"]').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        },
    });

    function showMessage(message, type = 'success') {
        $('#ajax-message')
            .removeClass('alert-success alert-error')
            .addClass(type === 'success' ? 'alert-success' : 'alert-error')
            .html(message)
            .show();
    }

    function notifyStudentsChanged() {
        localStorage.setItem(studentsChangedKey, Date.now().toString());
    }

    window.addEventListener('storage', function (event) {
        if (event.key === studentsChangedKey) {
            window.location.reload();
        }
    });

    function resetForm() {
        $('#student-id').val('');
        $('#fname').val('');
        $('#mname').val('');
        $('#lname').val('');
        $('#email').val('');
        $('#contact_no').val('');
        $('#degree_id').val('');
        $('#student-submit').text('Add Student');
        $('#cancel-edit').hide();
    }

    function studentData() {
        return {
            fname: $('#fname').val(),
            mname: $('#mname').val(),
            lname: $('#lname').val(),
            email: $('#email').val(),
            contact_no: $('#contact_no').val(),
            degree_id: $('#degree_id').val(),
        };
    }

    function escapeAttribute(value) {
        return $('<div>').text(value ?? '').html();
    }

    function studentRow(student) {
        const middleName = student.mname ? ` ${student.mname}` : '';

        return `
            <tr id="student-row-${student.id}">
                <td>${student.id}</td>
                <td>${student.lname}, ${student.fname}${middleName}</td>
                <td>${student.degree_title}</td>
                <td>${student.email}</td>
                <td>${student.contact_no}</td>
                <td><a href="${student.show_url}">View</a></td>
                <td>
                    <button
                        class="edit-student"
                        type="button"
                        data-id="${student.id}"
                        data-fname="${escapeAttribute(student.fname)}"
                        data-mname="${escapeAttribute(student.mname)}"
                        data-lname="${escapeAttribute(student.lname)}"
                        data-email="${escapeAttribute(student.email)}"
                        data-contact-no="${escapeAttribute(student.contact_no)}"
                        data-degree-id="${student.degree_id}"
                    >
                        Edit
                    </button>
                </td>
                <td>
                    <button class="delete-student" type="button" data-url="${student.update_url}">
                        Delete
                    </button>
                </td>
            </tr>
        `;
    }

    function renderStudents(students) {
        const rows = students.length
            ? students.map(studentRow).join('')
            : '<tr><td colspan="8">No student!</td></tr>';

        $('#students-table-body').html(rows);
    }

    function loadStudents(url = '/students') {
        if (!$('#students-table').length) {
            return;
        }

        $.get(url, function (response) {
            renderStudents(response.students);
        });
    }

    $('#student-submit').on('click', function () {
        const studentId = $('#student-id').val();
        const url = studentId ? `/students/${studentId}` : '/students';
        const method = 'POST';
        const data = studentData();

        if (studentId) {
            data._method = 'PUT';
        }

        $.ajax({
            url: url,
            type: method,
            data: data,
            success: function (response) {
                showMessage(response.message);
                notifyStudentsChanged();
                window.location.href = '/students';
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = Object.values(xhr.responseJSON.errors)
                        .flat()
                        .map(error => `<li>${error}</li>`)
                        .join('');

                    showMessage(`<ul>${errors}</ul>`, 'error');
                    return;
                }

                const message = xhr.responseJSON?.message
                    || xhr.responseText
                    || `Request failed with status ${xhr.status}.`;

                showMessage(message, 'error');
            },
        });
    });

    $(document).on('click', '.edit-student', function () {
        const $button = $(this);

        $('#student-id').val($button.attr('data-id'));
        $('#fname').val($button.attr('data-fname'));
        $('#mname').val($button.attr('data-mname'));
        $('#lname').val($button.attr('data-lname'));
        $('#email').val($button.attr('data-email'));
        $('#contact_no').val($button.attr('data-contact-no'));
        $('#degree_id').val($button.attr('data-degree-id'));
        $('#student-submit').text('Update Student');
        $('#cancel-edit').show();
        $('#ajax-message').hide();

        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    $('#cancel-edit').on('click', function () {
        resetForm();
        $('#ajax-message').hide();
    });

    $(document).on('click', '.delete-student', function () {
        if (!confirm('Delete this student?')) {
            return;
        }

        $.ajax({
            url: $(this).data('url'),
            type: 'DELETE',
            success: function (response) {
                showMessage(response.message);
                notifyStudentsChanged();
                window.location.reload();
            },
            error: function () {
                showMessage('Unable to delete student.', 'error');
            },
        });
    });

    loadStudents();
});
