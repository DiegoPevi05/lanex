@extends('layouts.dashboard')

@section('content-dashboard')
<section id="dashboard_users" class="bg-slate-50 h-full w-full flex flex-col p-4 sm:p-6 lg:p-8 gap-6 overflow-y-auto">
    <div class="max-w-7xl w-full mx-auto space-y-6">

        <!-- Top Header Card -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-6 sm:p-8 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md bg-purple-50 text-primary border border-purple-200/70 text-[11px] font-mono uppercase tracking-wider mb-2">
                        Seguridad &amp; Control de Acceso
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-display tracking-tight">
                        Gestión de Usuarios
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">
                        Solo los administradores pueden dar de alta a nuevos operadores y gestionar sus credenciales.
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <button
                        type="button"
                        onclick="document.getElementById('modal_create_user').classList.remove('hidden')"
                        class="h-11 px-5 rounded-xl bg-primary hover:bg-primary-dark text-white font-semibold text-xs sm:text-sm shadow-sm transition-all inline-flex items-center gap-2 cursor-pointer"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                        <span>Nuevo Usuario</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Success & Error Alerts -->
        @if (session('status'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                <div class="flex-1">
                    <p class="font-bold text-emerald-800">{{ session('status') }}</p>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 text-sm flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-rose-600 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>
                <div class="flex-1">
                    <p class="font-bold text-rose-800">Se encontraron los siguientes problemas:</p>
                    <ul class="text-xs mt-1 text-rose-700 list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Search Bar -->
        <div class="bg-white border border-slate-200/90 rounded-2xl p-4 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-3">
            <form action="{{ route('dashboard_user') }}" method="GET" class="w-full sm:w-80 relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </span>
                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Buscar por nombre o correo..."
                    class="w-full h-10 pl-10 pr-4 text-xs rounded-xl border border-slate-200 bg-slate-50 text-slate-900 placeholder:text-slate-400 focus:bg-white focus:border-primary focus:outline-none transition-all"
                >
            </form>

            <span class="text-xs text-slate-500 font-mono">
                Total: <strong>{{ $users->total() }}</strong> usuario(s) registrados
            </span>
        </div>

        <!-- Users Table Card -->
        <div class="bg-white border border-slate-200/90 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50/80 border-b border-slate-200/80 text-slate-500 font-mono uppercase tracking-wider">
                        <tr>
                            <th class="py-3.5 px-4 sm:px-6">Usuario</th>
                            <th class="py-3.5 px-4">Correo</th>
                            <th class="py-3.5 px-4">Rol</th>
                            <th class="py-3.5 px-4">Estado</th>
                            <th class="py-3.5 px-4">Fecha de Alta</th>
                            <th class="py-3.5 px-4 sm:px-6 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse ($users as $user)
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="py-4 px-4 sm:px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-purple-600/15 border border-purple-500/30 text-primary flex items-center justify-center font-bold text-sm uppercase shrink-0">
                                            {{ mb_substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900">{{ $user->name }}</p>
                                            <span class="text-[10px] text-slate-400 font-mono">ID: #OP-{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 font-medium text-slate-800">
                                    {{ $user->email }}
                                </td>
                                <td class="py-4 px-4">
                                    @if ($user->role === 'admin')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[11px] font-bold bg-purple-100 text-purple-800 border border-purple-200">
                                            Administrador
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[11px] font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                            Operador
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-4">
                                    @if ($user->is_active)
                                        <span class="inline-flex items-center gap-1.5 text-emerald-700 font-semibold text-xs">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Activo
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 text-slate-400 font-semibold text-xs">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                            Inactivo
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-slate-500 font-mono text-[11px]">
                                    {{ optional($user->created_at)->format('d/m/Y H:i') ?? '-' }}
                                </td>
                                <td class="py-4 px-4 sm:px-6 text-right">
                                    <div class="inline-flex items-center gap-2">
                                        <!-- Edit Button -->
                                        <button
                                            type="button"
                                            onclick="openEditUserModal({{ json_encode($user) }})"
                                            class="p-2 rounded-lg border border-slate-200 hover:border-primary hover:text-primary text-slate-600 transition-colors"
                                            title="Editar Usuario"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                        </button>

                                        <!-- Delete Button (Disabled for own user) -->
                                        @if (Auth::id() !== $user->id)
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Confirmas que deseas eliminar permanentemente a {{ $user->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="p-2 rounded-lg border border-red-200 hover:bg-red-50 text-red-600 transition-colors"
                                                    title="Eliminar Usuario"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-[10px] text-slate-400 font-mono px-2 py-1 bg-slate-100 rounded-md">
                                                Tu sesión
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-10 text-slate-500">
                                    No se encontraron usuarios registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($users->hasPages())
                <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                    {{ $users->links() }}
                </div>
            @endif
        </div>

    </div>
</section>

<!-- Modal: Create User -->
<div id="modal_create_user" class="hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xl max-w-md w-full p-6 sm:p-8 space-y-5 animate-fade-in">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div>
                <h3 class="text-lg font-bold text-slate-900 font-display">Crear Nuevo Usuario</h3>
                <p class="text-xs text-slate-500">Solo tú como administrador puedes crear cuentas operativas.</p>
            </div>
            <button type="button" onclick="document.getElementById('modal_create_user').classList.add('hidden')" class="text-slate-400 hover:text-slate-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>

        <form action="{{ route('user.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="create_name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nombre Completo *</label>
                <input type="text" id="create_name" name="name" required placeholder="Ej: Carlos Silva" class="w-full h-11 px-3.5 text-sm rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:border-primary focus:outline-none">
            </div>

            <div>
                <label for="create_email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Correo Electrónico *</label>
                <input type="email" id="create_email" name="email" required placeholder="operador@lanexsac.com" class="w-full h-11 px-3.5 text-sm rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:border-primary focus:outline-none">
            </div>

            <div>
                <label for="create_password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Contraseña Inicial *</label>
                <input type="password" id="create_password" name="password" required minlength="6" placeholder="Mínimo 6 caracteres" class="w-full h-11 px-3.5 text-sm rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:border-primary focus:outline-none">
                <p class="text-[11px] text-slate-400 mt-1">El usuario podrá restablecer su contraseña en cualquier momento con "Olvidé mi contraseña".</p>
            </div>

            <div>
                <label for="create_role" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Rol de Acceso *</label>
                <select id="create_role" name="role" required class="w-full h-11 px-3 text-sm rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:border-primary focus:outline-none">
                    <option value="operator">Operador (Gestión de Cargas y Contenido)</option>
                    <option value="admin">Administrador (Acceso Total y Usuarios)</option>
                </select>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('modal_create_user').classList.add('hidden')" class="px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-100">
                    Cancelar
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white text-xs font-semibold shadow-sm">
                    Crear Usuario
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Edit User -->
<div id="modal_edit_user" class="hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xl max-w-md w-full p-6 sm:p-8 space-y-5 animate-fade-in">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div>
                <h3 class="text-lg font-bold text-slate-900 font-display">Editar Usuario</h3>
                <p class="text-xs text-slate-500">Actualiza datos, rol o estado del operador.</p>
            </div>
            <button type="button" onclick="document.getElementById('modal_edit_user').classList.add('hidden')" class="text-slate-400 hover:text-slate-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>

        <form id="form_edit_user" action="" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="edit_name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nombre Completo *</label>
                <input type="text" id="edit_name" name="name" required class="w-full h-11 px-3.5 text-sm rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:border-primary focus:outline-none">
            </div>

            <div>
                <label for="edit_email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Correo Electrónico *</label>
                <input type="email" id="edit_email" name="email" required class="w-full h-11 px-3.5 text-sm rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:border-primary focus:outline-none">
            </div>

            <div>
                <label for="edit_password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Nueva Contraseña (Opcional)</label>
                <input type="password" id="edit_password" name="password" minlength="6" placeholder="Dejar en blanco si no deseas cambiarla" class="w-full h-11 px-3.5 text-sm rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:border-primary focus:outline-none">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="edit_role" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Rol *</label>
                    <select id="edit_role" name="role" required class="w-full h-11 px-3 text-sm rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:border-primary focus:outline-none">
                        <option value="operator">Operador</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>

                <div>
                    <label for="edit_is_active" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">Estado *</label>
                    <select id="edit_is_active" name="is_active" required class="w-full h-11 px-3 text-sm rounded-xl border border-slate-300 bg-slate-50 focus:bg-white focus:border-primary focus:outline-none">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('modal_edit_user').classList.add('hidden')" class="px-4 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-100">
                    Cancelar
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-primary hover:bg-primary-dark text-white text-xs font-semibold shadow-sm">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditUserModal(user) {
    const form = document.getElementById('form_edit_user');
    form.action = `/dashboard/users/update/${user.id}`;

    document.getElementById('edit_name').value = user.name || '';
    document.getElementById('edit_email').value = user.email || '';
    document.getElementById('edit_password').value = '';
    document.getElementById('edit_role').value = user.role || 'operator';
    document.getElementById('edit_is_active').value = user.is_active ? '1' : '0';

    document.getElementById('modal_edit_user').classList.remove('hidden');
}
</script>
@endsection
