import React, {useState} from "react";
import Popup from 'reactjs-popup';

function Action({actionColor}) {

  return (
    <div className="actions">
        <button>Edit</button>
        <button>{actionColor.status ? 'Deactivate' : 'Activate'}</button>
        <button>Delete</button>
    </div>
  );
}

export default Action;