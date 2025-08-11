\DB::connection()->getPDO();
echo "Connected to database successfully: " . \DB::connection()->getDatabaseName();
