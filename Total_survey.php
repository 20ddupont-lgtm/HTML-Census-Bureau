<?php
// 1. START THE SESSION TO GET ACCESS TO YOUR ARRAYS
session_start();

// 2. INITIALIZE TRACKING VARIABLES FOR YOUR CALCULATIONS
$totalHouseholds 	= 0;
$ohioHouseholds  	= 0;
$hamiltonHouseholds = 0;
$butlerHouseholds 	= 0;
$kyHouseholds    	= 0;
$booneHouseholds 	= 0;
$kentonHouseholds 	= 0;

// 3. ONLY LOOP IF THE ARRAYS EXIST AND ARE NOT EMPTY
if (isset($_SESSION['arr_states']) && !empty($_SESSION['arr_states'])) {
    
    // Find out how many items are currently in the parallel arrays
    $totalEntries = count($_SESSION['arr_states']);
    
    // Loop through the arrays using a standard counter loop
    for ($i = 0; $i < $totalEntries; $i++) {
        
        // Accumulate the absolute total count of entries
        $totalHouseholds++;
        
        // Grab the state abbreviation for the current array index
        $currentState = $_SESSION['arr_states'][$i];
        
        // Run your conditional logic to process the states separately
        if ($currentState === 'oh') {
            $ohioHouseholds++;
        } elseif ($currentState === 'ky') {
            $kyHouseholds++;
        }
    }
}

if (isset($_SESSION['arr_counties']) && !empty($_SESSION['arr_counties'])) {
    
    // Find out how many items are currently in the parallel arrays
    $totalEntries = count($_SESSION['arr_counties']);
    
    // Loop through the arrays using a standard counter loop
    for ($i = 0; $i < $totalEntries; $i++) {
        
        // Grab the state abbreviation for the current array index
        $currentCounty = $_SESSION['arr_counties'][$i];
        
        // Run your conditional logic to process the states separately
        if ($currentCounty === 'hamilton') {
            $hamiltonHouseholds++;
        } else if ($currentCounty === 'butler') {
            $butlerHouseholds++;
        } else if ($currentCounty === 'boone') {
            $booneHouseholds++;
		} else if ($currentCounty === 'kenton') {
            $kentonHouseholds++;
		}
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Total Households Surveyed</title>
  <style>
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: var(--font-stack);
      background-color: #f4f6f8;
    }
	
    :root {
      --bg-color: #002b49;       /* Deep federal blue */
      --text-color: #ffffff;
      --hover-color: #005a9c;    /* Lighter blue for hover */
      --active-color: #f1c40f;   /* Accent gold */
      --font-stack: system-ui, -apple-system, sans-serif;
    }	
	
    /* NAVBAR LAYOUT */
	.navbar {
	  background-color: var(--bg-color);
	  display: flex;
	  flex-direction: column;    /* Stack the logo container and the menu vertically */
	  align-items: center;       /* Center align everything horizontally */
	  padding: 1rem 1.5rem;      /* Slightly increased top/bottom padding for breathing room */
	  position: sticky;
	  top: 0;
	  z-index: 1000;
	  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
	  gap: 1rem;                 /* Creates clean spacing between the logo and the link row */
	}
	
	/* LOGO WRAPPER */
	.logo-container {
	  display: flex;
	  align-items: center;       /* Centers text vertically with the middle of the logo image */
	  justify-content: center;   /* Centers the entire grouping horizontally */
	  text-decoration: none;     /* Removes underlines from the text since it's inside an <a> tag */
	  gap: 0.75rem;              /* Spacing between the text and the sides of the logo image */
	}	

	/* LOGO SIZE */
	.logo-img {
	  height: 120px;
	  width: auto;
	  display: block;
	}
	
	.logo-text {
	  color: var(--text-color);
	  font-size: 1.5rem;         /* Clean, readable size matching a header hierarchy */
	  font-weight: 700;          /* Strong typographic weight */
	  text-transform: uppercase; /* Clean federal look */
	  letter-spacing: 1px;       /* Adds subtle professional spacing between letters */
	}	

    /* DESKTOP NAVIGATION LINKS */
    .nav-menu {
      display: flex;
      list-style: none;
      align-items: center;
      gap: 1rem;                      
    }

    .nav-link {
      color: var(--text-color);
      text-decoration: none;
      padding: 0.5rem 0.75rem;
      border-radius: 4px;
      font-size: 0.95rem;             /* Font scaling rules */
      font-weight: 500;
      transition: background-color 0.2s ease, color 0.2s ease;
    }

    .nav-link:hover,
    .nav-link:focus {
      background-color: var(--hover-color);
      outline: none;
    }

    .nav-link.active {
      border-bottom: 2px solid var(--active-color);
      border-radius: 4px 4px 0 0;     
    }

    /* Hide the mobile toggle element on desktop viewports */
    .nav-toggle {
      display: none;
    }
	
    /* RESULTS CARD CONTAINER LAYOUT */
    .results-card {
      max-width: 500px;
      margin: 2rem auto;              
      background: #ffffff;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
	
    h1 {
      color: #002b49;
      font-size: 1.5rem;
      margin-bottom: 1.5rem;
      border-bottom: 2px solid #f1c40f;
      padding-bottom: 0.5rem;
    }
	
    .stat-row {
      display: flex;
      justify-content: space-between;
      padding: 0.75rem 0;
      border-bottom: 1px solid #eee;
    }
	
    .stat-row:last-child {
      border: none;
    }
	
    .stat-label {
      font-weight: 600;
      color: #333;
    }
	
    .stat-value {
      font-weight: 700;
      color: #005a9c;
    }
	
    .back-link {
      display: inline-block;
      margin-top: 1.5rem;
      color: #002b49;
      text-decoration: none;
      font-weight: 600;
    }
	
    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <header>
    <nav class="navbar" aria-label="Main navigation">
		<a href="index.html" class="logo-container">
		<span class="logo-text">Census</span>
			<img src="images/Census_Bureau.png" alt="Company Logo" class="logo-img">
			<span class="logo-text">Bureau</span>
		</a>
      
      <button class="nav-toggle" aria-expanded="false" aria-controls="nav-menu" aria-label="Toggle navigation menu">
        <span class="hamburger"></span>
      </button>

      <ul class="nav-menu" id="nav-menu">
        <li><a href="index.html" class="nav-link">Home</a></li>
        <li><a href="Total_survey.php" class="nav-link active">Total Households Surveyed</a></li>
        <li><a href="Average_household.php" class="nav-link">Average Household Income</a></li>
        <li><a href="Poverty_percentage.php" class="nav-link">Percentage Below Poverty</a></li>
      </ul>
    </nav>
  </header>

  <div class="results-card">
    <h1>Total Households Surveyed</h1>
    
    <div class="stat-row">
      <span class="stat-label">Total Households Surveyed (All States):</span>
      <span class="stat-value"><?php echo $totalHouseholds; ?></span>
    </div>

    <div class="stat-row">
      <span class="stat-label">Ohio Households Surveyed:</span>
      <span class="stat-value"><?php echo $ohioHouseholds; ?></span>
    </div>
	
    <div class="stat-row">
      <span class="stat-label">Hamilton Households Surveyed:</span>
      <span class="stat-value"><?php echo $hamiltonHouseholds; ?></span>
    </div>	
	
    <div class="stat-row">
      <span class="stat-label">Butler Households Surveyed:</span>
      <span class="stat-value"><?php echo $butlerHouseholds; ?></span>
    </div>		

    <div class="stat-row">
      <span class="stat-label">Kentucky Households Surveyed:</span>
      <span class="stat-value"><?php echo $kyHouseholds; ?></span>
    </div>
	
    <div class="stat-row">
      <span class="stat-label">Boone Households Surveyed:</span>
      <span class="stat-value"><?php echo $booneHouseholds; ?></span>
    </div>	
	
    <div class="stat-row">
      <span class="stat-label">Kenton Households Surveyed:</span>
      <span class="stat-value"><?php echo $kentonHouseholds; ?></span>
    </div>		

    <a href="index.html" class="back-link">&larr; Return to Dashboard</a>
  </div>

</body>
</html>