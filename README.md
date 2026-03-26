# 🍌 Banana Store API - Swagger UI Live Coding Demo

A fun, interactive demonstration of **Swagger UI** with Laravel. Learn how OpenAPI annotations automatically generate beautiful, testable API documentation!

---

## 🧐 What is Swagger UI?

**Swagger UI is like a digital menu for your code.**

Imagine you walk into a restaurant:
- The **kitchen** = Your API code
- The **food** = Your data
- The **menu** = Swagger UI

Without Swagger UI, to test your API you would need to:
- Write confusing text files explaining how to use it
- Use terminal commands that are hard to remember
- Keep documentation separate from your code (which gets out of sync)

**With Swagger UI**, you get:
- ✅ A beautiful, interactive web page that updates automatically
- ✅ "Try it out" buttons to test your API directly from the browser
- ✅ Auto-generated forms for sending data
- ✅ Clear documentation of what data comes back
- ✅ Professional-looking interface

---

## 💡 Why Use Swagger UI?

1. **Saves Massive Time**: No need to write separate manuals—the documentation builds itself
2. **Prevents Mistakes**: Shows exactly what information is required before sending
3. **Makes Testing Fun**: Anyone can test the API with one click, no special tools needed
4. **Keeps Code & Docs In Sync**: Documentation lives in code comments, so they're always together
5. **Professional Appearance**: Impresses clients and stakeholders

---

## 🍌 The Banana Store Project

This is a fun, real-world demo of a banana inventory management system API.

**Project Idea**: We're building the backend system for a high-tech banana stand 🌴

**What we can do with the API:**
- 🟢 **GET** - Check how many bananas are in stock
- 🟡 **POST** - Add new banana types to the inventory
- 🔵 **PUT** - Update banana information (price, quantity, etc)
- 🔴 **DELETE** - Remove banana types from the system

---

## 🛠️ Technologies Used

- **Laravel 11** - PHP Framework
- **L5-Swagger** - Swagger integration for Laravel
- **OpenAPI 3.0** - API specification standard
- **MySQL** - Database (included with migrations)

---

## 📦 Installation & Setup

### Step 1: Install Swagger Package
```bash
composer require darkaonline/l5-swagger
```

### Step 2: Publish Configuration
```bash
php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
```

### Step 3: Enable Auto-Generation (Optional but recommended)
Add to your `.env` file:
```env
L5_SWAGGER_GENERATE_ALWAYS=true
```

This makes Swagger regenerate every time you refresh the page, perfect for live coding!

### Step 4: Generate Swagger Documentation
```bash
php artisan l5-swagger:generate
```

### Step 5: Run Migrations & Seed Data
```bash
php artisan migrate:fresh --seed
```

This creates the `bananas` table and adds 15 test bananas to your database.

### Step 6: Start the Server
```bash
php artisan serve
```

### Step 7: View Your API Documentation
Open in your browser:
```
http://localhost:8000/api/documentation
```

---

## 📝 Understanding @OA Annotations

### What is @OA?

`@OA` stands for **OpenAPI Annotation**. It's a special comment format that tells Swagger how to document your API.

**Rule**: One annotation block = One function. Don't mix multiple annotations on one function!

---

### 1️⃣ GET - Reading Data (List All)

Gets all bananas from the database.

```php
/**
 * @OA\Get(
 *     path="/api/bananas",
 *     summary="Get all bananas",
 *     description="Returns a list of all bananas in stock",
 *     tags={"Bananas"},
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="Cavendish Banana"),
 *                 @OA\Property(property="description", type="string", example="Sweet and creamy"),
 *                 @OA\Property(property="price", type="number", example=0.99),
 *                 @OA\Property(property="quantity", type="integer", example=100)
 *             )
 *         )
 *     ),
 *     @OA\Response(response=401, description="Unauthenticated")
 * )
 */
public function index()
{
    return Banana::all();
}
```

**Breaking it down:**
- `path="/api/bananas"` - The web address
- `summary="Get all bananas"` - Short title
- `tags={"Bananas"}` - Groups this with other Banana operations
- `@OA\Response` - Describes what comes back
- `@OA\Items` - Shows the structure of each item in the list

---

### 2️⃣ POST - Creating New Data

Adds a new banana type to the inventory.

```php
/**
 * @OA\Post(
 *     path="/api/bananas",
 *     summary="Create a new banana type",
 *     tags={"Bananas"},
 *     @OA\RequestBody(
 *         required=true,
 *         description="Banana data",
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Red Banana"),
 *             @OA\Property(property="description", type="string", example="Vibrant red color"),
 *             @OA\Property(property="price", type="number", example=1.49),
 *             @OA\Property(property="quantity", type="integer", example=50)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Banana created successfully!",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=16),
 *             @OA\Property(property="name", type="string", example="Red Banana")
 *         )
 *     )
 * )
 */
public function store(Request $request)
{
    $banana = Banana::create($request->all());
    return response()->json($banana, 201);
}
```

**Breaking it down:**
- `@OA\RequestBody` - **NEW!** This shows what data you need to SEND
- `required=true` - You MUST provide this data
- Everything inside shows the form fields Swagger will create

---

### 3️⃣ PUT - Updating Existing Data

Updates an existing banana's information.

```php
/**
 * @OA\Put(
 *     path="/api/bananas/{id}",
 *     summary="Update a banana",
 *     tags={"Bananas"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="The ID of the banana to update",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="price", type="number", example=1.99),
 *             @OA\Property(property="quantity", type="integer", example=75)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Banana updated successfully!"
 *     )
 * )
 */
public function update(Request $request, $id)
{
    $banana = Banana::find($id);
    $banana->update($request->all());
    return response()->json($banana);
}
```

**Breaking it down:**
- `path="/api/bananas/{id}"` - Notice the `{id}` - this is a variable!
- `@OA\Parameter` - **NEW!** This describes that variable
- `in="path"` - The ID comes from the URL path
- You can update just some fields, don't have to send all of them

---

### 4️⃣ DELETE - Removing Data

Deletes a banana type from the system.

```php
/**
 * @OA\Delete(
 *     path="/api/bananas/{id}",
 *     summary="Delete a banana",
 *     tags={"Bananas"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="The ID of the banana to delete",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Banana deleted successfully!"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Banana not found"
 *     )
 * )
 */
public function destroy($id)
{
    Banana::find($id)->delete();
    return response()->json(["message" => "Banana deleted!"]);
}
```

**Breaking it down:**
- Similar to PUT, but no RequestBody (you're not sending data, just saying which one to delete)
- Shows multiple responses - 200 if successful, 404 if not found

---

## 📄 API Base Information

This goes in your main Controller class or a dedicated documentation controller:

```php
/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="🍌 Banana Store API",
 *     description="Interactive Swagger UI Demonstration - Manage your banana inventory!"
 * )
 * @OA\PathItem(path="/api")
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
```

---

## 🧪 Testing Your API in Swagger UI

1. **Open** `http://localhost:8000/api/documentation`
2. **Click** on any endpoint (GET, POST, PUT, DELETE)
3. **Click** the blue "Try it out" button
4. **Fill in** any required fields
5. **Click** the "Execute" button
6. **See** the response in real-time!

---

## ⚡ Common Mistakes to Avoid

### ❌ Mistake 1: Mixing annotations on one function
```php
// DON'T DO THIS!
/**
 * @OA\Get(path="/api/bananas", ...)
 * @OA\Post(path="/api/bananas", ...)  // WRONG!
 */
public function index() { }
```

✅ **Solution**: Create separate functions for each operation

### ❌ Mistake 2: Incomplete annotation syntax
```php
// DON'T DO THIS - Missing closing parenthesis
/**
 * @OA\Get(
 *     path="/api/bananas",
 *     summary="Get bananas"
 *     // Missing closing )
 */
```

✅ **Solution**: Always close your @OA\ blocks with closing parenthesis

### ❌ Mistake 3: Forgetting to regenerate
After editing annotations, run:
```bash
php artisan l5-swagger:generate
```

Or just refresh the page if `L5_SWAGGER_GENERATE_ALWAYS=true`

---

## 🚀 Quick Command Reference

```bash
# Install Swagger
composer require darkaonline/l5-swagger

# Publish config files
php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"

# Generate Swagger documentation
php artisan l5-swagger:generate

# Clear generated documentation (if you need to reset)
php artisan l5-swagger:publish

# Run migrations
php artisan migrate

# Run migrations & seed
php artisan migrate:fresh --seed

# Start development server
php artisan serve

# View documentation
# Go to: http://localhost:8000/api/documentation
```

---

## 📁 Project Structure

```
app/
  Http/
    Controllers/
      BananaController.php    <- Banana API endpoints with @OA annotations
  Models/
    Banana.php                <- Banana model

database/
  factories/
    BananaFactory.php         <- Generates fake banana data for testing
  migrations/
    *_create_bananas_table.php <- Database table structure
  seeders/
    DatabaseSeeder.php        <- Seeds test data into database

routes/
  api.php                      <- API routes (GET, POST, PUT, DELETE endpoints)
```

---

## 📊 Database Schema

**Bananas Table:**
| Column | Type | Description |
|--------|------|-------------|
| id | Integer | Unique identifier (Primary Key) |
| name | String | Banana variety name (e.g., "Cavendish") |
| description | Text | Detailed description |
| price | Decimal | Price per banana (8,2 format) |
| quantity | Integer | How many in stock |
| created_at | Timestamp | When added to database |
| updated_at | Timestamp | When last modified |

---

## 🎯 Live Coding Presentation Tips

1. **Start with WHY**: Explain that APIs are like kitchens, and Swagger is the menu
2. **Show the Code**: Point to the @OA annotations in your controller
3. **Show the Magic**: Switch to the browser and show Swagger UI instantly picked it up
4. **Test Live**: Click "Try it out" and show real data being returned
5. **Explain the Flow**: Walk through what happens when you click Execute
6. **Show Errors**: Try invalid data to show error handling
7. **Highlight the Contrast**: Show that ugly code becomes beautiful documentation

---

## 💡 Why This Project is Perfect for Learning

✅ **Simple to understand** - Everyone knows what a banana is!
✅ **Shows all CRUD operations** - GET, POST, PUT, DELETE
✅ **Real database** - Uses actual migrations and seeders
✅ **Mock data included** - BananaFactory generates realistic test data
✅ **Fully documented** - Advanced @OA annotations with multiple response types
✅ **Production-ready** - This is how real APIs are documented

---

## 🔗 Useful Resources

- [Swagger UI Official Docs](https://swagger.io/tools/swagger-ui/)
- [OpenAPI 3.0 Specification](https://spec.openapis.org/oas/v3.0.0)
- [L5-Swagger GitHub](https://github.com/DarkaOnline/L5-Swagger)
- [Laravel Documentation](https://laravel.com/docs)

---

## 👨‍💻 Developed By

**Aya Nakkabi** & **Ilyas Doughmi**

*Created for YouCode Live Coding Training*

🍌 **Happy Banana Storing!** 🍌
