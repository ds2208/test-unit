import { useEffect, useState } from 'react';
import { Container, Card, Table } from 'react-bootstrap';
import { IoAddCircleSharp } from 'react-icons/io5';
import { Link } from 'react-router-dom';
import { deleteColor, getColors } from '../../services/colors-service';
import Toaster from '../_layout/Toaster';
import Color from './partials/Color';

function List() {

  const [colors, setColors] = useState<any[]>([]);
  const [showChangeToast, setShowChangeToast] = useState(false);

  useEffect(() => {
    getColors().then(result => {
      setColors(result.data.data.colors);
    })
  }, []);

  const handleShowChangeToast = () => setShowChangeToast(!showChangeToast);

  const removeColor = (colorId: number): any => {
    const response = deleteColor(colorId);
    response.catch(errors => {
      console.log(errors);
    }).then(result => {
      if (result) {
        const newColors = colors.filter((color) => color.id !== colorId);
        setColors(newColors);
      }
    });
  }

  return (
    <>
      <Toaster
        id="status"
        show={showChangeToast}
        title="Change Status"
        message="Status has been changed!"
        handleShow={handleShowChangeToast}
      />
      <Container className='mt-5'>
        <Card bg='dark' text="light" border='light'>
          <Card.Header className='d-flex justify-content-between'>
            <Card.Title>List of Colors</Card.Title>
            <Link className='btn btn-outline-light' to={"/colors/new"}> Create <IoAddCircleSharp /></Link>
          </Card.Header>
          <Card.Body>
            <Table striped hover variant="dark" className='text-center'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Color Name</th>
                  <th>Hex Value</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                {
                  colors.map(color => {
                    return (
                      <Color key={color.id} color={color} removeColor={removeColor} handleShowChangeToast={handleShowChangeToast}></Color>
                    )
                  })
                }
              </tbody>
            </Table>
          </Card.Body>
        </Card>
      </Container>
    </>
  );
}

export default List;
