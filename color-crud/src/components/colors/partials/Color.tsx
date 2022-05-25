import { useState } from "react";
import { IoCloseCircleOutline, IoColorWandOutline, IoGitCompareOutline } from "react-icons/io5";
import { useNavigate } from "react-router-dom";
import { changeStatus } from "../../../services/colors-service";
import PopUp from "../../_layout/PopUp";

function Color({ color, removeColor, handleShowChangeToast }: ColorProps) {

  const navigate = useNavigate();
  const [id, setId] = useState(color.id);
  const [name, setName] = useState(color.name);
  const [hex_value, setHexValue] = useState(color.hex_value);
  const [status, setStatus] = useState(color.status);

  const [showChange, setShowChange] = useState(false);

  const [showDelete, setShowDelete] = useState(false);

  const handleShowChange = () => setShowChange(!showChange);
  const handleShowDelete = () => setShowDelete(!showDelete);

  const changeActive = (colorId: number): any => {
    const response = changeStatus(colorId);
    response.catch(errors => {
      console.log(errors);
    }).then(result => {
      if (result) {
        setStatus(result.data.data.color.status);
        handleShowChange();
        handleShowChangeToast();
      }
    });
  }

  const fetchToChangeColor = (colorId: number): any => {
    navigate(`/colors/${colorId}/edit`);
  }

  return (
    <>
      <tr>
        <td>{id ?? "#"}</td>
        <td>{name ?? ""}</td>
        <td>{hex_value ?? "N/A"}</td>
        <td className={status ? "text-success" : "text-danger"}>{status ? "Active" : "Disabled"}</td>
        <td>
          <a className='btn btn-outline-warning m-3' onClick={() => (fetchToChangeColor(id))}>
            <IoColorWandOutline />
          </a>
          <a className='btn btn-outline-info m-3' onClick={handleShowChange}>
            <IoGitCompareOutline />
          </a>
          <a className='btn btn-outline-danger m-3' onClick={handleShowDelete}>
            <IoCloseCircleOutline />
          </a>
        </td>
      </tr>
      <PopUp
        id="status"
        show={showChange}
        title="Change Status"
        message="Are you sure want to change color status?"
        handleShow={handleShowChange}
        subButtonTitle="Change"
        submitFunction={() => (changeActive(id))}
      />
      <PopUp
        id="delete"
        show={showDelete}
        title="Delete Color"
        message="Are you sure do you want to delete color?"
        handleShow={handleShowDelete}
        subButtonTitle="Delete"
        submitFunction={() => (removeColor(id))}
      />
    </>
  );
}

interface ColorProps {
  color: {
    id: number,
    name: string,
    hex_value: string,
    status: boolean
  },
  removeColor: any,
  handleShowChangeToast: any
};

export default Color;