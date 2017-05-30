// <?php
/*
 * |--------------------------------------------------------------------------
 * | Model Factories
 * |--------------------------------------------------------------------------
 * |
 * | Here you may define all of your model factories. Model factories give
 * | you a convenient way to create models for testing and seeding your
 * | database. Just tell the factory how a default model should look.
 * |
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */
/*
 |-------------------------------------------------------------------------------
 | Custom Type Definitions
 |-------------------------------------------------------------------------------
 */
function getTypePhone(Faker\Generator $faker){
	return $faker->randomElements(array('Work', 'Cell', 'Home', "VoIP"));
}
function getTypeEmail(Faker\Generator $faker){
	return $faker->randomElements(array('Work', 'Home'));
}
function getTypeAddress(Faker\Generator $faker){
	return $faker->randomElements(array('Work', 'Home', 'P.O.'));
}

/*
 * |-------------------------------------------------------------------------------
 * | User Factories
 * |-------------------------------------------------------------------------------
 */
$factory->define ( App\User::class, function (Faker\Generator $faker) {
	static $password;

	return [
			'name' => $faker->name,
			'email' => $faker->unique ()->safeEmail,
			'password' => $password ?: $password = bcrypt ( 'secret' ),
			'remember_token' => str_random ( 10 )
	];
} );
/*
 * |-------------------------------------------------------------------------------
 * | Contact Factories
 * |-------------------------------------------------------------------------------
 */
$factory->define ( App\Contact::class, function (Faker\Generator $faker) {

	return [
			'first_name' => $faker->firstName,
			'last_name' => $faker->lastName
	];
} );
$factory->define ( App\Contact_phone::class, function (Faker\Generator $faker) {
			$phone_number = $faker->unique->phoneNumber;
			$type = getTypePhone($faker);
	return [
			'phone_number' => "$phone_number",
			'type' => "$type",
			'is_primary' => $faker->boolean ( 50 )
	];
} );

$factory->define ( App\Contact_email::class, function (Faker\Generator $faker) {
	$email = $faker->unique ()->safeEmail;
	$type = getTypeEmail($faker);
	return [
			'email' => "$email",
			'type' => "$type",
			'is_primary' => $faker->boolean ( 50 )
	];
} );

$factory->define ( App\Contact_place::class, function (Faker\Generator $faker) {
	$address_line_1 = $faker->unique()->streetAddresss();
	$address_line_2 = $faker->uniquie()->optional(0.1)->secondaryAddress;
	$city = $faker->city;
	$state = $faker->stateAbbr;
	$zip = $faker->postcode;
	$country = $faker->country;
	$type = getTypeAddress($faker);
	return [
			'address_line_1' => "$address_line_1",
			'address_line_2' => "$address_line_2",
			'city' => "$city",
			'state' => "$state",
			'zip' => "$zip",
			'country' => "$country",
			'type' => "$type",
			'is_primary' => $faker->boolean ( 50 )
	];
} );

/*
 * |-------------------------------------------------------------------------------
 * | Sponsor Factories
 * |-------------------------------------------------------------------------------
 */
$factory->define ( App\Sponsor::class, function (Faker\Generator $faker) {
	return [
			'name' => $faker->company + ' ' + $faker->companySuffix,
			'web_url' => $faker->url,
			'logo_url' => $faker->imageUrl ( 100, 600, 'cats' )
	];
} );
$factory->define ( App\Sponsor_phone::class, function (Faker\Generator $faker) {

	return [
			'phone_number' => $faker->unique ()->phoneNumber,
			'type' => getTypePhone ( $faker ),
			'is_primary' => $faker->boolean ( 50 )
	];
} );

$factory->define ( App\Sponsor_email::class, function (Faker\Generator $faker) {
	return [
			'email' => $faker->unique ()->safeEmail,
			'type' => getTypeEmail ( $faker ),
			'is_primary' => $faker->boolean ( 50 )
	];
} );

$factory->define ( App\Sponsor_place::class, function (Faker\Generator $faker) {
	return [
			'address_line_1' => $faker->unique ()->streetAddress,
			'address_line_2' => $faker->unique ()->optional ( 0.1 )->secondaryAddress,
			'city' => $faker->city,
			'state' => $faker->stateAbbr,
			'zip' => $faker->postcode,
			'country' => $faker->country,
			'type' => getTypeAddress ( $faker ),
			'is_primary' => $faker->boolean ( 50 )
	];
} );

/*
 * |-------------------------------------------------------------------------------
 * | Donation Factories
 * |-------------------------------------------------------------------------------
 */
$factory->define ( App\Donation::class, function (Faker\Generator $faker) {
	return [
			'amount' => $faker->randomFloat ( 2, 0, 5000 ),
			'date_received' => $faker->dateTimeThisCentury ( 'now', date_default_timezone_get () ),
			'notes' => $faker->realText ()
	];
} );
