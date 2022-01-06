<div>
  <div class="flex justify-between my-6 mx-3">
    <div class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Roles
    </div>
    <div>
        <button 
        x-on:click="window.livewire.emitTo('add-new-role-component','showModal')"
          class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Add New Role <span class="ml-2" aria-hidden="true">+</span>
        </button>
    </div>
  </div>

<div class="w-full overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
              <!-- Role search box -->
              <div class="flex flex-1 lg:mr-32 my-2">
                <div
                  class="relative w-full max-w-xl mr-6 focus-within:text-purple-500"
                >
                  <div class="absolute inset-y-0 flex items-center pl-2">
                    <svg
                      class="w-4 h-4"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                  </div>
                  <input
                    class="w-full py-2 pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                    type="text"
                    placeholder="Search roles"
                    aria-label="Search"
                    wire:model="searchKeyword"
                  />
                </div>
              </div>
              <!--Role Search box ends --> 
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Name</th>
                      <th class="px-4 py-3">Actions</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                    @forelse($roles as $role)
                      <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                          <div class="flex items-center text-sm">
                            <div>
                              <p class="font-semibold">{{$role->name}}</p>
                            </div>
                          </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                          <i x-on:click="window.livewire.emitTo('show-role-component','showModal', {{$role}})" class="fas fa-eye text-indigo-500 px-1 cursor-pointer"></i>
                          <i x-on:click="window.livewire.emitTo('edit-role-component','showModal', {{$role}})" class="fa fa-pencil text-indigo-500 px-1 cursor-pointer"></i>
                          <i class="fas fa-trash text-indigo-500 px-1 cursor-pointer"
                          x-data={} 
                          x-on:click="window.livewire.emitTo('delete-modal-component','showModal', 'Spatie\\Permission\\Models\\Role', {{$role->id}}, 'Delete Role', 'Are you sure you want to delete role {{$role->name}}')"></i>
                        </td>
                      </tr>
                      @empty
                    <tr class="text-gray-600 dark:text-gray-400">
                        @if(isset($searchKeyword))
                        <td colspan="2" class="p-3">
                        No roles found matching your search keyword
                        </td>
                        @else
                        <td colspan="2" class="p-3">
                        No roles in the database
                        </td>
                        @endif
                    </tr>
                    @endforelse                  
                  </tbody>
                </table>
              </div>
              <div class="mx-2 my-3">
                  {{$roles->links()}}
              </div>
</div>
</div>
<div wire:key="add-role">
  <livewire:add-new-role-component>
</div>
<div wire:key="delete-modal">
  <livewire:delete-modal-component>
</div>
<div wire:key="edit-role">
  <livewire:edit-role-component>
</div>
<div wire:key="show-role">
  <livewire:show-role-component>
</div>


