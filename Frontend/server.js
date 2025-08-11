const express = require("express");
const path = require("path");
const app = express();

// Enable CORS for API requests to backend
app.use((req, res, next) => {
  res.header("Access-Control-Allow-Origin", "*");
  res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
  next();
});

// Serve static files
app.use(express.static(path.join(__dirname, "../dist")));

// Any route that doesn't match a static file should serve the index.html
app.get("*", (req, res) => {
  res.sendFile(path.join(__dirname, "../dist/index.html"));
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, "0.0.0.0", () => {
  console.log(`Frontend server running on port ${PORT}`);
});
