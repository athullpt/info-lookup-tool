<!DOCTYPE html>
<html>
<head>
  <title>Info Lookup Tool</title>
  <style>
    button {
      color: red;
    }
  </style>
</head>
<body>
<center>
<h1>Info</h1>
<form method="POST">
  <table align="center" cellpadding="10" style="background-color: #000; color: #fff; border: 1px solid #444; border-radius: 10px; padding: 20px; box-shadow: 0 0 10px rgba(255,255,255,0.1);">
    <tr>
      <td colspan="2" align="center">
        <input type="text" name="query" placeholder="Domain/IP/Phone" required
               style="width: 320px; padding: 10px; font-size: 16px; border-radius: 6px; border: 1px solid #aaa; background-color: #111; color: #fff;">
      </td>
    </tr>
    <tr>
      <td align="center">
        <button name="action" value="whois"
                style="width: 150px; height: 40px; background-color: #dc3545; color: white; border: none; border-radius: 5px; font-size: 14px; cursor: pointer;">
          Domain Whois
        </button>
      </td>
      <td align="center">
        <button name="action" value="ip"
                style="width: 150px; height: 40px; background-color: #007bff; color: white; border: none; border-radius: 5px; font-size: 14px; cursor: pointer;">
          IP Details
        </button>
      </td>
    </tr>
    <tr>
      <td align="center">
        <button name="action" value="subdomain"
                style="width: 150px; height: 40px; background-color: #28a745; color: white; border: none; border-radius: 5px; font-size: 14px; cursor: pointer;">
          Subdomains
        </button>
      </td>
      <td align="center">
        <button name="action" value="phone"
                style="width: 150px; height: 40px; background-color: #ffc107; color: black; border: none; border-radius: 5px; font-size: 14px; cursor: pointer;">
          Phone Info
        </button>
      </td>
    </tr>
  </table>
</form>
</center>
<pre>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = escapeshellarg($_POST["query"]);
    $action = $_POST["action"];

    if ($action == "whois") {
        echo shell_exec("whois $query");
    } elseif ($action == "ip") {
    $ip = escapeshellcmd($_POST["query"]);
    $url = "http://ip-api.com/json/$ip";
    $response = shell_exec("curl -s \"$url\"");
    $data = json_decode($response, true);

    if ($data["status"] === "success") {
        echo "<h3>🌐 IP Lookup Result:</h3>";
        echo "<p><strong>IP:</strong> " . htmlspecialchars($data["query"]) . "</p>";
        echo "<p><strong>Country:</strong> " . htmlspecialchars($data["country"]) . " (" . htmlspecialchars($data["countryCode"]) . ")</p>";
        echo "<p><strong>Region:</strong> " . htmlspecialchars($data["regionName"]) . " (" . htmlspecialchars($data["region"]) . ")</p>";
        echo "<p><strong>City:</strong> " . htmlspecialchars($data["city"]) . "</p>";
        echo "<p><strong>ZIP Code:</strong> " . htmlspecialchars($data["zip"]) . "</p>";
        echo "<p><strong>Latitude / Longitude:</strong> " . htmlspecialchars($data["lat"]) . " / " . htmlspecialchars($data["lon"]) . "</p>";
        echo "<p><strong>Timezone:</strong> " . htmlspecialchars($data["timezone"]) . "</p>";
        echo "<p><strong>ISP:</strong> " . htmlspecialchars($data["isp"]) . "</p>";
        echo "<p><strong>Organization:</strong> " . htmlspecialchars($data["org"]) . "</p>";
        echo "<p><strong>AS:</strong> " . htmlspecialchars($data["as"]) . "</p>";
    } else {
        echo "<p style='color:red;'>❌ IP lookup failed.</p>";
    }
    } elseif ($action == "subdomain") {
        echo shell_exec("sublist3r -d $query");
    } elseif ($action == "phone") {
        $apiKey = "Your API key"; // Your API key
        $cleanPhone = escapeshellcmd($_POST["query"]);
        $url = "https://phonevalidation.abstractapi.com/v1/?api_key=$apiKey&phone=$cleanPhone";
        $response = shell_exec("curl -s \"$url\"");
        $data = json_decode($response, true);

        if (isset($data["valid"])) {
            echo "<h3>📞 Phone Lookup Result:</h3>";
            echo "<p><strong>Phone:</strong> " . htmlspecialchars($data["phone"]) . "</p>";
            echo "<p><strong>Valid:</strong> " . ($data["valid"] ? "Yes" : "No") . "</p>";
            echo "<p><strong>International Format:</strong> " . htmlspecialchars($data["format"]["international"]) . "</p>";
            echo "<p><strong>Local Format:</strong> " . htmlspecialchars($data["format"]["local"]) . "</p>";
            echo "<p><strong>Country:</strong> " . htmlspecialchars($data["country"]["name"]) . " (" . htmlspecialchars($data["country"]["code"]) . ")</p>";
            echo "<p><strong>Prefix:</strong> " . htmlspecialchars($data["country"]["prefix"]) . "</p>";
            echo "<p><strong>Location:</strong> " . htmlspecialchars($data["location"]) . "</p>";
            echo "<p><strong>Type:</strong> " . htmlspecialchars($data["type"]) . "</p>";
            echo "<p><strong>Carrier:</strong> " . htmlspecialchars($data["carrier"]) . "</p>";
        } else {
            echo "<p style='color:red;'>❌ Invalid API response or key.</p>";
        }
    }
}
?>

</pre>
</body>
</html>

