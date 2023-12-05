function openDialog123(item) {
  var content = $('.dialog-content');

  // Clear previous content
  content.html('');

  // Create a table element
  var table = $('<table></table>').addClass('table table-bordered table-striped table-fixed table-hover');

  content.append(`<h4 style="text-align:center;">Student Info</h4>`);
  content.append(`<hr>`);

    // Key renaming and formatting mapping
    var keyMappings = {
    'rank': 'SOC Rank',
    'rankSIDD' : 'SIDD Rank'
    // Add more key mappings as needed
    };

  // Populate table with data
  $.each(item, function(key, value) {
    // Skip properties like 'id', 'created_at', 'updated_at' which should not be displayed
    if (key === 'id' || key === 'created_at' || key === 'updated_at' 
    || key === 'placement_id' || key === 'eligibility_status' || key === 'totalSOC' 
    || key === 'totalSIDD') {
      return;
    }

    // Skip properties with null values
    if (value === null) {
      return;
    }

    var mappedKey = keyMappings[key] || key;

    var row = $('<tr></tr>');
    row.append('<td>' + 
    mappedKey.charAt(0).toUpperCase() + mappedKey.slice(1).replace(/_/g, ' ')
    + '</td>');
    row.append('<td>' + (value || '-') + '</td>');
    table.append(row);
  });

  // Append the table to the content
  content.append(table);

  // Add a styled close button
  var closeButton = $('<button></button>')
    .text('Close')
    .attr('onclick', 'closeDialog123()')
    .css({
      'background-color': '#ddd',
      'color': '#333',
      'border': 'none',
      'padding': '10px 20px',
      'border-radius': '5px',
      'cursor': 'pointer',
      'float': 'right',
    });

  content.append(closeButton);

  // Show the dialog
  $('#infoDialog')[0].showModal();
}

function closeDialog123() {
    // Close the dialog
    $('#infoDialog')[0].close();
  }