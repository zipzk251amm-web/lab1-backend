// ========== ЗМІННІ ==========
let currentUserId = null;
let currentUserName = '';

// ========== ПОКАЗ/ПРИХОВУВАННЯ ФОРМ ==========
function showRegisterForm() {
    document.getElementById('loginForm').style.display = 'none';
    document.getElementById('registerForm').style.display = 'block';
}

function showLoginForm() {
    document.getElementById('registerForm').style.display = 'none';
    document.getElementById('loginForm').style.display = 'block';
}

// ========== РЕЄСТРАЦІЯ ==========
async function register() {
    const name = document.getElementById('regName').value;
    const email = document.getElementById('regEmail').value;
    const password = document.getElementById('regPassword').value;

    if (!name || !email || !password) {
        showMessage('Заповніть всі поля!', 'error');
        return;
    }

    const response = await fetch('api/register.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name, email, password })
    });

    const result = await response.json();
    
    if (result.success) {
        showMessage(result.message, 'success');
        showLoginForm();
        document.getElementById('regName').value = '';
        document.getElementById('regEmail').value = '';
        document.getElementById('regPassword').value = '';
    } else {
        showMessage(result.message, 'error');
    }
}

// ========== ВХІД ==========
async function login() {
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;

    if (!email || !password) {
        showMessage('Заповніть всі поля!', 'error');
        return;
    }

    const response = await fetch('api/login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, password })
    });

    const result = await response.json();
    
    if (result.success) {
        currentUserId = result.user.id;
        currentUserName = result.user.name;
        
        document.getElementById('userName').innerText = currentUserName;
        document.getElementById('authPanel').style.display = 'none';
        document.getElementById('userPanel').style.display = 'block';
        document.getElementById('usersPanel').style.display = 'block';
        document.getElementById('editProfilePanel').style.display = 'block';
        document.getElementById('notesPanel').style.display = 'block';
        
        document.getElementById('editName').value = result.user.name;
        document.getElementById('editEmail').value = result.user.email;
        
        loadUsers();
        loadNotes();
        showMessage('Вітаємо, ' + currentUserName + '!', 'success');
    } else {
        showMessage(result.message, 'error');
    }
}

// ========== ВИХІД ==========
function logout() {
    currentUserId = null;
    document.getElementById('authPanel').style.display = 'block';
    document.getElementById('userPanel').style.display = 'none';
    document.getElementById('usersPanel').style.display = 'none';
    document.getElementById('editProfilePanel').style.display = 'none';
    document.getElementById('notesPanel').style.display = 'none';
    
    document.getElementById('loginEmail').value = '';
    document.getElementById('loginPassword').value = '';
}

// ========== ОТРИМАННЯ СПИСКУ КОРИСТУВАЧІВ ==========
async function loadUsers() {
    const response = await fetch('api/get_users.php');
    const result = await response.json();
    
    if (result.success) {
        const usersList = document.getElementById('usersList');
        usersList.innerHTML = '';
        
        result.users.forEach(user => {
            const userDiv = document.createElement('div');
            userDiv.className = 'user-item';
            userDiv.innerHTML = `
                <h3>${escapeHtml(user.name)}</h3>
                <p>📧 ${escapeHtml(user.email)}</p>
                <p>📅 Зареєстрований: ${user.created_at}</p>
            `;
            usersList.appendChild(userDiv);
        });
    }
}

// ========== ОНОВЛЕННЯ ПРОФІЛЮ ==========
async function updateProfile() {
    const name = document.getElementById('editName').value;
    const email = document.getElementById('editEmail').value;

    const response = await fetch('api/update_user.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: currentUserId, name, email })
    });

    const result = await response.json();
    
    if (result.success) {
        currentUserName = name;
        document.getElementById('userName').innerText = currentUserName;
        showMessage(result.message, 'success');
        loadUsers();
    } else {
        showMessage(result.message, 'error');
    }
}

// ========== ВИДАЛЕННЯ ПРОФІЛЮ ==========
async function deleteProfile() {
    if (confirm('Ви впевнені, що хочете видалити свій профіль? Цю дію не можна скасувати!')) {
        const response = await fetch('api/delete_user.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: currentUserId })
        });

        const result = await response.json();
        
        if (result.success) {
            showMessage(result.message, 'success');
            logout();
        } else {
            showMessage(result.message, 'error');
        }
    }
}

// ========== ЗАМІТКИ ==========
async function loadNotes() {
    const response = await fetch(`api/get_notes.php?user_id=${currentUserId}`);
    const result = await response.json();
    
    if (result.success) {
        const notesList = document.getElementById('notesList');
        notesList.innerHTML = '';
        
        result.notes.forEach(note => {
            const noteDiv = document.createElement('div');
            noteDiv.className = 'note-item';
            noteDiv.id = `note-${note.id}`;
            noteDiv.innerHTML = `
                <h3>📌 ${escapeHtml(note.title)}</h3>
                <p>${escapeHtml(note.content).replace(/\n/g, '<br>')}</p>
                <small>📅 ${note.updated_at}</small>
                <div class="note-actions">
                    <button onclick="showEditNote(${note.id}, '${escapeHtml(note.title).replace(/'/g, "\\'")}', '${escapeHtml(note.content).replace(/'/g, "\\'")}')">✏️ Редагувати</button>
                    <button class="danger" onclick="deleteNote(${note.id})">🗑️ Видалити</button>
                </div>
                <div class="edit-note" id="edit-note-${note.id}">
                    <input type="text" id="edit-title-${note.id}" value="${escapeHtml(note.title)}">
                    <textarea id="edit-content-${note.id}">${escapeHtml(note.content)}</textarea>
                    <button onclick="updateNote(${note.id})">💾 Зберегти зміни</button>
                    <button onclick="hideEditNote(${note.id})">❌ Скасувати</button>
                </div>
            `;
            notesList.appendChild(noteDiv);
        });
    }
}

function showEditNote(id, title, content) {
    const editDiv = document.getElementById(`edit-note-${id}`);
    editDiv.style.display = 'block';
}

function hideEditNote(id) {
    const editDiv = document.getElementById(`edit-note-${id}`);
    editDiv.style.display = 'none';
}

async function updateNote(id) {
    const title = document.getElementById(`edit-title-${id}`).value;
    const content = document.getElementById(`edit-content-${id}`).value;

    const response = await fetch('api/update_note.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id, title, content })
    });

    const result = await response.json();
    
    if (result.success) {
        showMessage(result.message, 'success');
        loadNotes();
    } else {
        showMessage(result.message, 'error');
    }
}

async function addNote() {
    const title = document.getElementById('noteTitle').value;
    const content = document.getElementById('noteContent').value;

    if (!title || !content) {
        showMessage('Заповніть заголовок та текст замітки!', 'error');
        return;
    }

    const response = await fetch('api/add_note.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ user_id: currentUserId, title, content })
    });

    const result = await response.json();
    
    if (result.success) {
        showMessage(result.message, 'success');
        document.getElementById('noteTitle').value = '';
        document.getElementById('noteContent').value = '';
        loadNotes();
    } else {
        showMessage(result.message, 'error');
    }
}

async function deleteNote(id) {
    if (confirm('Видалити замітку?')) {
        const response = await fetch('api/delete_note.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id })
        });

        const result = await response.json();
        
        if (result.success) {
            showMessage(result.message, 'success');
            loadNotes();
        } else {
            showMessage(result.message, 'error');
        }
    }
}

// ========== ДОПОМІЖНІ ФУНКЦІЇ ==========
function showMessage(msg, type) {
    const msgDiv = document.createElement('div');
    msgDiv.className = `message ${type}`;
    msgDiv.innerText = msg;
    
    const container = document.querySelector('.container');
    container.insertBefore(msgDiv, container.firstChild);
    
    setTimeout(() => msgDiv.remove(), 3000);
}

function escapeHtml(str) {
    if (!str) return '';
    return str.replace(/[&<>]/g, function(m) {
        if (m === '&') return '&amp;';
        if (m === '<') return '&lt;';
        if (m === '>') return '&gt;';
        return m;
    });
}