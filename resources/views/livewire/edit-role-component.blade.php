<div x-data="{
    show: @entangle('showModal')
 }" x-show="show" x-cloak>
  <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

      <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

      <!-- This element is to trick the browser into centering the modal contents. -->
      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

      <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
        <div class="bg-white dark:bg-gray-800 dark:text-gray-400 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="sm:flex md:items-center sm:items-start">
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
              <!-- Heroicon name: outline/exclamation -->
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M20.822 18.096c-3.439-.794-6.641-1.49-5.09-4.418 4.719-8.912 1.251-13.678-3.732-13.678-5.081 0-8.464 4.949-3.732 13.678 1.597 2.945-1.725 3.641-5.09 4.418-2.979.688-3.178 2.143-3.178 4.663l.005 1.241h10.483l.704-3h1.615l.704 3h10.483l.005-1.241c.001-2.52-.198-3.975-3.177-4.663zm-8.231 1.904h-1.164l-.91-2h2.994l-.92 2z" />
              </svg>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
              <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-300" id="modal-title">
                Edit Role {{isset($role) ?  __('roles.' . $role->name)  : ''}}
              </h3>
            </div>
          </div>
          <div class="mt-2 w-full">
            <div class="flex flex-wrap -mx-3 my-6">
              <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2" for="roleName">
                  Role Name
                </label>
                <input wire:model="role.name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:focus:shadow-outline-gray dark:border-gray-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="roleName" type="text" placeholder="Provide New Role Name">
                <p class="text-gray-600 text-xs italic dark:text-gray-400">Role name should be unique</p>
                @error('role.name') <span class="error text-red-400">{{ $message }}</span> @enderror
              </div>
            </div>
            <div class="flex-grow flex-wrap -mx-3 my-6">
              <div class="w-full px-3" wire:ignore>
                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-300 text-xs font-bold mb-2" for="permissionSelect">
                  Attach Permissions
                </label>
                <select style="width: 100%" class="select select-bordered w-full select2" id="permissionSelect" multiple="multiple">
                  @foreach($allPermissions as $permission)
                  <option id="{{$permission->name}}">{{ __('permissions.' . $permission->name) }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 dark:bg-gray-800 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button wire:click="save" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-purple-600 text-base font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
            Save
          </button>
          <button wire:click="closeModal" x-on:click="show = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border dark:bg-gray-700 dark:text-gray-200 border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener('livewire:load', function(event) {

      @this.on('refreshPermissionSelect', function() {
        let associatedPermissions = [];

        $.each(@this.associatedPermissions, function(key, associatedPermission) {
          associatedPermissions.push(associatedPermission)
        });

        $('#permissionSelect').val(associatedPermissions);

        $('#permissionSelect').select2({
          tags: true,
          tokenSeparators: [',']
        });

        $('#permissionSelect').trigger('change');

        $('#permissionSelect').on('change', function(e) {
          @this.set('associatedPermissions', $(this).val());
        });
      });


    });
  </script>
</div>