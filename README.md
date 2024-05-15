
## Address Book Laravel Project

### Project Setup
1. Create a new Laravel project:
   ```bash
   laravel new addressbook
   cd addressbook
   ```

2. Implement User Authentication:
   ```bash
   composer require laravel/ui
   php artisan ui vue --auth
   npm install && npm run dev
   php artisan migrate
   ```

3. Create Address Book Model and Migration:
   ```bash
   php artisan make:model AddressBook -m
   ```

4. Define Migration:
   ```php
   public function up()
   {
       Schema::create('address_books', function (Blueprint $table) {
           $table->id();
           $table->string('name');
           $table->string('address');
           $table->string('phone');
           $table->foreignId('user_id')->constrained()->onDelete('cascade');
           $table->timestamps();
       });
   }
   ```

5. Run Migration:
   ```bash
   php artisan migrate
   ```

6. Set Up Relationships in Models:
   - In `User.php`:
     ```php
     public function addressBooks()
     {
         return $this->hasMany(AddressBook::class);
     }
     ```

   - In `AddressBook.php`:
     ```php
     public function user()
     {
         return $this->belongsTo(User::class);
     }
     ```

7. Create Controller and Define Routes:
   ```bash
   php artisan make:controller AddressBookController
   ```

   - In `routes/web.php`:
     ```php
     Route::resource('addressbooks', AddressBookController::class);
     ```

8. Implement CRUD Methods in Controller:
   ```php
   public function index()
   {
       $addressBooks = auth()->user()->addressBooks;
       return view('addressbooks.index', compact('addressBooks'));
   }

   public function create()
   {
       return view('addressbooks.create');
   }

   public function store(Request $request)
   {
       $request->validate([
           'name' => 'required',
           'address' => 'required',
           'phone' => 'required',
       ]);

       auth()->user()->addressBooks()->create($request->all());
       return redirect()->route('addressbooks.index');
   }

   public function edit(AddressBook $addressBook)
   {
       return view('addressbooks.edit', compact('addressBook'));
   }

   public function update(Request $request, AddressBook $addressBook)
   {
       $request->validate([
           'name' => 'required',
           'address' => 'required',
           'phone' => 'required',
       ]);

       $addressBook->update($request->all());
       return redirect()->route('addressbooks.index');
   }

   public function destroy(AddressBook $addressBook)
   {
       $addressBook->delete();
       return redirect()->route('addressbooks.index');
   }
   ```

9. Create Views:
   - Create the necessary Blade templates in `resources/views/addressbooks` for `index`, `create`, `edit`, and `show` views.

### Testing the Application

Ensure to test the following functionalities:
- User registration, login, and logout.
- Creating, reading, updating, and deleting address book entries.
